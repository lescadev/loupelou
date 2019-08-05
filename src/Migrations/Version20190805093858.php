<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190805093858 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE particulier (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_6CC4D4F3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, comptoir_id INT NOT NULL, montant DOUBLE PRECISION NOT NULL, date_transaction DATETIME NOT NULL, INDEX IDX_723705D1A76ED395 (user_id), INDEX IDX_723705D1AEB0C1F5 (comptoir_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comptoir (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, site_internet VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, denomination VARCHAR(255) NOT NULL, solde DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_A6E2C35EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE informations_legales (id INT AUTO_INCREMENT NOT NULL, cgu LONGTEXT NOT NULL, cgv LONGTEXT NOT NULL, mentions_legales LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, telephone VARCHAR(45) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(45) NOT NULL, date_creation DATETIME NOT NULL, is_active TINYINT(1) DEFAULT \'1\' NOT NULL, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, description LONGTEXT DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE informations (id INT AUTO_INCREMENT NOT NULL, slogan VARCHAR(255) DEFAULT NULL, presentation LONGTEXT NOT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(10) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, telephone VARCHAR(25) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, titre_presentation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, object VARCHAR(255) DEFAULT NULL, message LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adhesion (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, debut_adhesion DATETIME NOT NULL, fin_adhesion DATETIME DEFAULT NULL, INDEX IDX_C50CA65AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenements (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, image VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, title VARCHAR(255) NOT NULL, image_description VARCHAR(255) NOT NULL, lien_event VARCHAR(255) DEFAULT NULL, lieu VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, site_internet VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, denomination VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_60A26480A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire_categorie (id INT NOT NULL, categorie INT NOT NULL, INDEX IDX_80B50294BF396750 (id), INDEX IDX_80B50294497DD634 (categorie), PRIMARY KEY(id, categorie)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_blog (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, is_active TINYINT(1) DEFAULT \'1\' NOT NULL, image_description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_880E0D76F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE informations_association (id INT AUTO_INCREMENT NOT NULL, statuts LONGTEXT NOT NULL, reglement_interieur LONGTEXT NOT NULL, compte_rendu_ag LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE particulier ADD CONSTRAINT FK_6CC4D4F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1AEB0C1F5 FOREIGN KEY (comptoir_id) REFERENCES comptoir (id)');
        $this->addSql('ALTER TABLE comptoir ADD CONSTRAINT FK_A6E2C35EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE adhesion ADD CONSTRAINT FK_C50CA65AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE prestataire_categorie ADD CONSTRAINT FK_80B50294BF396750 FOREIGN KEY (id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE prestataire_categorie ADD CONSTRAINT FK_80B50294497DD634 FOREIGN KEY (categorie) REFERENCES categorie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prestataire_categorie DROP FOREIGN KEY FK_80B50294497DD634');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1AEB0C1F5');
        $this->addSql('ALTER TABLE particulier DROP FOREIGN KEY FK_6CC4D4F3A76ED395');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1A76ED395');
        $this->addSql('ALTER TABLE comptoir DROP FOREIGN KEY FK_A6E2C35EA76ED395');
        $this->addSql('ALTER TABLE adhesion DROP FOREIGN KEY FK_C50CA65AA76ED395');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480A76ED395');
        $this->addSql('ALTER TABLE prestataire_categorie DROP FOREIGN KEY FK_80B50294BF396750');
        $this->addSql('DROP TABLE particulier');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE comptoir');
        $this->addSql('DROP TABLE informations_legales');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE informations');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE adhesion');
        $this->addSql('DROP TABLE evenements');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE prestataire_categorie');
        $this->addSql('DROP TABLE article_blog');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE informations_association');
    }
}
