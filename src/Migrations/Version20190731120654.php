<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190731120654 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE prestataire_has_categorie (id INT AUTO_INCREMENT NOT NULL, prestataire_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_4EA8E7C0BE3DB2B7 (prestataire_id), INDEX IDX_4EA8E7C0BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prestataire_has_categorie ADD CONSTRAINT FK_4EA8E7C0BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE prestataire_has_categorie ADD CONSTRAINT FK_4EA8E7C0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('DROP TABLE prestataire_categorie');
        $this->addSql('ALTER TABLE user ADD password_requested_at DATETIME DEFAULT NULL, ADD token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE prestataire_categorie (id INT NOT NULL, categorie INT NOT NULL, INDEX IDX_80B50294BF396750 (id), INDEX IDX_80B50294497DD634 (categorie), PRIMARY KEY(id, categorie)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE prestataire_categorie ADD CONSTRAINT FK_80B50294497DD634 FOREIGN KEY (categorie) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE prestataire_categorie ADD CONSTRAINT FK_80B50294BF396750 FOREIGN KEY (id) REFERENCES prestataire (id)');
        $this->addSql('DROP TABLE prestataire_has_categorie');
        $this->addSql('ALTER TABLE user DROP password_requested_at, DROP token');
    }
}
