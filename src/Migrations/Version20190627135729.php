<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190627135729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('CREATE TABLE activity (id INT IDENTITY NOT NULL, name NVARCHAR(255) NOT NULL, profile NVARCHAR(255) NOT NULL, date DATETIME NOT NULL, status NVARCHAR(255) NOT NULL, rank INT NOT NULL, type NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('DROP TABLE project');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('CREATE SCHEMA dbo');
        $this->addSql('CREATE TABLE project (id INT IDENTITY NOT NULL, name NVARCHAR(255) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL, profile NVARCHAR(255) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL, date DATETIME NOT NULL, status NVARCHAR(255) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL, rank INT NOT NULL, type NVARCHAR(255) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL, PRIMARY KEY (id))');
        $this->addSql('DROP TABLE activity');
    }
}
