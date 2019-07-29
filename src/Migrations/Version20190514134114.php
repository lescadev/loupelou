<?php

declare( strict_types=1 );

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190514134114
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

        $this->addSql( 'CREATE TABLE adhesion (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, debut_adhesion DATETIME NOT NULL, fin_adhesion DATETIME DEFAULT NULL, INDEX IDX_C50CA65AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB' );
        $this->addSql( 'ALTER TABLE adhesion ADD CONSTRAINT FK_C50CA65AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)' );
        $this->addSql( 'ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE telephone telephone VARCHAR(45) DEFAULT NULL' );
    }

    public function down( Schema $schema ): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf( $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.' );

        $this->addSql( 'DROP TABLE adhesion' );
        $this->addSql( 'ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE telephone telephone VARCHAR(45) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci' );
    }
}
