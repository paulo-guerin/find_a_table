<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190906115030 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D41FB8D185');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D475E23604');
        $this->addSql('DROP INDEX IDX_D044D5D41FB8D185 ON session');
        $this->addSql('DROP INDEX IDX_D044D5D475E23604 ON session');
        $this->addSql('ALTER TABLE session DROP host_id, DROP town_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE session ADD host_id INT DEFAULT NULL, ADD town_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D41FB8D185 FOREIGN KEY (host_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D475E23604 FOREIGN KEY (town_id) REFERENCES town (id)');
        $this->addSql('CREATE INDEX IDX_D044D5D41FB8D185 ON session (host_id)');
        $this->addSql('CREATE INDEX IDX_D044D5D475E23604 ON session (town_id)');
    }
}
