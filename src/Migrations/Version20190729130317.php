<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190729130317 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE prestataire_categorie (id INT NOT NULL, categorie INT NOT NULL, INDEX IDX_80B50294BF396750 (id), INDEX IDX_80B50294497DD634 (categorie), PRIMARY KEY(id, categorie)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prestataire_categorie ADD CONSTRAINT FK_80B50294BF396750 FOREIGN KEY (id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE prestataire_categorie ADD CONSTRAINT FK_80B50294497DD634 FOREIGN KEY (categorie) REFERENCES categorie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE prestataire_categorie');
    }
}
