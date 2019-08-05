<?php

declare( strict_types=1 );

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190802151222
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

        $this->addSql( 'ALTER TABLE user ADD password_requested_at DATETIME DEFAULT NULL, ADD token VARCHAR(255) DEFAULT NULL' );
        $this->addSql( 'ALTER TABLE evenements ADD image VARCHAR(255) NOT NULL, ADD image_description VARCHAR(255) NOT NULL, DROP logo, DROP logo_description, CHANGE lien_event lien_event VARCHAR(255) DEFAULT NULL' );
    }

    public function down( Schema $schema ): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf( $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.' );

        $this->addSql( 'ALTER TABLE evenements ADD logo VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD logo_description VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP image, DROP image_description, CHANGE lien_event lien_event VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci' );
        $this->addSql( 'ALTER TABLE user DROP password_requested_at, DROP token' );
    }
}
