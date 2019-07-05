<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190705145301 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('CREATE TABLE pole (id INT IDENTITY NOT NULL, name NVARCHAR(255) NOT NULL, code_pole NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE profile (id INT IDENTITY NOT NULL, name NVARCHAR(255) NOT NULL, code_profile NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE tjm (id INT IDENTITY NOT NULL, project_id INT, pole_id INT, amount INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_A88756166D1F9C ON tjm (project_id)');
        $this->addSql('CREATE INDEX IDX_A88756419C3385 ON tjm (pole_id)');
        $this->addSql('ALTER TABLE tjm ADD CONSTRAINT FK_A88756166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE tjm ADD CONSTRAINT FK_A88756419C3385 FOREIGN KEY (pole_id) REFERENCES pole (id)');
        $this->addSql('ALTER TABLE collaborators ADD profile_id INT');
        $this->addSql('ALTER TABLE collaborators ADD CONSTRAINT FK_42DD9F54CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('CREATE INDEX IDX_42DD9F54CCFA12B8 ON collaborators (profile_id)');
        $this->addSql('ALTER TABLE project DROP COLUMN type');
        $this->addSql('ALTER TABLE project DROP COLUMN cost');
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
        $this->addSql('ALTER TABLE tjm DROP CONSTRAINT FK_A88756419C3385');
        $this->addSql('ALTER TABLE collaborators DROP CONSTRAINT FK_42DD9F54CCFA12B8');
        $this->addSql('DROP TABLE pole');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE tjm');
        $this->addSql('IF EXISTS (SELECT * FROM sysobjects WHERE name = \'IDX_42DD9F54CCFA12B8\')
            ALTER TABLE collaborators DROP CONSTRAINT IDX_42DD9F54CCFA12B8
        ELSE
            DROP INDEX IDX_42DD9F54CCFA12B8 ON collaborators');
        $this->addSql('ALTER TABLE collaborators DROP COLUMN profile_id');
        $this->addSql('ALTER TABLE project ADD type NVARCHAR(255) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL');
        $this->addSql('ALTER TABLE project ADD cost INT NOT NULL');
    }
}
