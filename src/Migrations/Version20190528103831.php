<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190528103831 extends AbstractMigration
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
        $this->addSql('CREATE TABLE prestataire_has_categorie (id INT AUTO_INCREMENT NOT NULL, prestataire_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_4EA8E7C0BE3DB2B7 (prestataire_id), INDEX IDX_4EA8E7C0BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE informations_legales (id INT AUTO_INCREMENT NOT NULL, cgu LONGTEXT NOT NULL, cgv LONGTEXT NOT NULL, mentions_legales LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adhesion (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, debut_adhesion DATETIME NOT NULL, fin_adhesion DATETIME DEFAULT NULL, INDEX IDX_C50CA65AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, telephone VARCHAR(45) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(45) NOT NULL, date_creation DATETIME NOT NULL, is_active TINYINT(1) DEFAULT \'1\' NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE particulier (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_6CC4D4F3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, site_internet VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_60A26480A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comptoir (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, site_internet VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_A6E2C35EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prestataire_has_categorie ADD CONSTRAINT FK_4EA8E7C0BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE prestataire_has_categorie ADD CONSTRAINT FK_4EA8E7C0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE adhesion ADD CONSTRAINT FK_C50CA65AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE particulier ADD CONSTRAINT FK_6CC4D4F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comptoir ADD CONSTRAINT FK_A6E2C35EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adhesion DROP FOREIGN KEY FK_C50CA65AA76ED395');
        $this->addSql('ALTER TABLE particulier DROP FOREIGN KEY FK_6CC4D4F3A76ED395');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480A76ED395');
        $this->addSql('ALTER TABLE comptoir DROP FOREIGN KEY FK_A6E2C35EA76ED395');
        $this->addSql('ALTER TABLE prestataire_has_categorie DROP FOREIGN KEY FK_4EA8E7C0BCF5E72D');
        $this->addSql('ALTER TABLE prestataire_has_categorie DROP FOREIGN KEY FK_4EA8E7C0BE3DB2B7');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE prestataire_has_categorie');
        $this->addSql('DROP TABLE informations_legales');
        $this->addSql('DROP TABLE adhesion');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE particulier');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE comptoir');
    }
}
