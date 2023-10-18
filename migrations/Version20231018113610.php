<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231018113610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bijou DROP FOREIGN KEY FK_E4B4D7949F34925F');
        $this->addSql('DROP INDEX IDX_E4B4D7949F34925F ON bijou');
        $this->addSql('ALTER TABLE bijou ADD categorie_id INT NOT NULL, DROP id_categorie_id');
        $this->addSql('ALTER TABLE bijou ADD CONSTRAINT FK_E4B4D794BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_E4B4D794BCF5E72D ON bijou (categorie_id)');
        $this->addSql('ALTER TABLE location ADD client_id INT DEFAULT NULL, ADD bijou_id INT NOT NULL');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB9E2EF1B5 FOREIGN KEY (bijou_id) REFERENCES bijou (id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CB19EB6921 ON location (client_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E9E89CB9E2EF1B5 ON location (bijou_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bijou DROP FOREIGN KEY FK_E4B4D794BCF5E72D');
        $this->addSql('DROP INDEX IDX_E4B4D794BCF5E72D ON bijou');
        $this->addSql('ALTER TABLE bijou ADD id_categorie_id INT DEFAULT NULL, DROP categorie_id');
        $this->addSql('ALTER TABLE bijou ADD CONSTRAINT FK_E4B4D7949F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_E4B4D7949F34925F ON bijou (id_categorie_id)');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB19EB6921');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB9E2EF1B5');
        $this->addSql('DROP INDEX IDX_5E9E89CB19EB6921 ON location');
        $this->addSql('DROP INDEX UNIQ_5E9E89CB9E2EF1B5 ON location');
        $this->addSql('ALTER TABLE location DROP client_id, DROP bijou_id');
    }
}
