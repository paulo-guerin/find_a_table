<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190716092304 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE chat_message (id INT AUTO_INCREMENT NOT NULL, msgcontent LONGTEXT NOT NULL, iduser INT NOT NULL, idsession INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_com_score (id INT AUTO_INCREMENT NOT NULL, commentary LONGTEXT DEFAULT NULL, score INT DEFAULT NULL, iduser INT NOT NULL, idgame INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE games ADD idcategory INT NOT NULL');
        $this->addSql('ALTER TABLE users ADD idtown INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE chat_message');
        $this->addSql('DROP TABLE game_com_score');
        $this->addSql('ALTER TABLE games DROP idcategory');
        $this->addSql('ALTER TABLE users DROP idtown');
    }
}
