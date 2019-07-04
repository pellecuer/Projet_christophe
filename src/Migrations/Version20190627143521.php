<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190627143521 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('CREATE TABLE project (id INT IDENTITY NOT NULL, name NVARCHAR(255) NOT NULL, code NVARCHAR(255) NOT NULL, type NVARCHAR(255) NOT NULL, cost INT NOT NULL, start_at DATETIME NOT NULL, end_at DATETIME NOT NULL, PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE activity ADD project_id INT');
        $this->addSql('ALTER TABLE activity DROP COLUMN name');
        $this->addSql('ALTER TABLE activity DROP COLUMN profile');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_AC74095A166D1F9C ON activity (project_id)');
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
        $this->addSql('ALTER TABLE activity DROP CONSTRAINT FK_AC74095A166D1F9C');
        $this->addSql('DROP TABLE project');
        $this->addSql('IF EXISTS (SELECT * FROM sysobjects WHERE name = \'IDX_AC74095A166D1F9C\')
            ALTER TABLE activity DROP CONSTRAINT IDX_AC74095A166D1F9C
        ELSE
            DROP INDEX IDX_AC74095A166D1F9C ON activity');
        $this->addSql('ALTER TABLE activity ADD name NVARCHAR(255) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL');
        $this->addSql('ALTER TABLE activity ADD profile NVARCHAR(255) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL');
        $this->addSql('ALTER TABLE activity DROP COLUMN project_id');
    }
}
