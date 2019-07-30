<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190729144005 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE informations ADD logo VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, ADD titre_presentation VARCHAR(255) NOT NULL, DROP image_1, DROP image_2, DROP image_3');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE informations ADD image_1 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD image_2 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD image_3 VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP logo, DROP updated_at, DROP titre_presentation');
    }
}
