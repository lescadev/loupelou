<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190515144154 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE telephone telephone VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE prestataire CHANGE site_internet site_internet VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE comptoir CHANGE site_internet site_internet VARCHAR(255) DEFAULT NULL, CHANGE siret siret VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE adhesion CHANGE fin_adhesion fin_adhesion DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE admin');
        $this->addSql('ALTER TABLE adhesion CHANGE fin_adhesion fin_adhesion DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE comptoir CHANGE site_internet site_internet VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE siret siret VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE prestataire CHANGE site_internet site_internet VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE telephone telephone VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
