<?php

declare( strict_types=1 );

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190514140021
    extends AbstractMigration
{

    public function getDescription(): string
    {
        return '';
    }

    public function up( Schema $schema ): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf( $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.' );

        $this->addSql( 'CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, site_internet VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_60A26480A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB' );
        $this->addSql( 'CREATE TABLE particulier (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_6CC4D4F3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB' );
        $this->addSql( 'CREATE TABLE comptoir (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, site_internet VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_A6E2C35EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB' );
        $this->addSql( 'ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)' );
        $this->addSql( 'ALTER TABLE particulier ADD CONSTRAINT FK_6CC4D4F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)' );
        $this->addSql( 'ALTER TABLE comptoir ADD CONSTRAINT FK_A6E2C35EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)' );
        $this->addSql( 'ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE telephone telephone VARCHAR(45) DEFAULT NULL' );
        $this->addSql( 'ALTER TABLE adhesion CHANGE fin_adhesion fin_adhesion DATETIME DEFAULT NULL' );
    }

    public function down( Schema $schema ): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf( $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.' );

        $this->addSql( 'DROP TABLE prestataire' );
        $this->addSql( 'DROP TABLE particulier' );
        $this->addSql( 'DROP TABLE comptoir' );
        $this->addSql( 'ALTER TABLE adhesion CHANGE fin_adhesion fin_adhesion DATETIME DEFAULT \'NULL\'' );
        $this->addSql( 'ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE telephone telephone VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci' );
    }
}
