<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190710093319 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('ALTER TABLE activity ADD profile_id INT');
        $this->addSql('ALTER TABLE activity ADD pole_id INT');
        $this->addSql('ALTER TABLE activity DROP COLUMN status');
        $this->addSql('ALTER TABLE activity DROP COLUMN type');
        $this->addSql('ALTER TABLE activity DROP COLUMN profile');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095ACCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A419C3385 FOREIGN KEY (pole_id) REFERENCES pole (id)');
        $this->addSql('CREATE INDEX IDX_AC74095ACCFA12B8 ON activity (profile_id)');
        $this->addSql('CREATE INDEX IDX_AC74095A419C3385 ON activity (pole_id)');
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
        $this->addSql('ALTER TABLE activity DROP CONSTRAINT FK_AC74095ACCFA12B8');
        $this->addSql('ALTER TABLE activity DROP CONSTRAINT FK_AC74095A419C3385');
        $this->addSql('IF EXISTS (SELECT * FROM sysobjects WHERE name = \'IDX_AC74095ACCFA12B8\')
            ALTER TABLE activity DROP CONSTRAINT IDX_AC74095ACCFA12B8
        ELSE
            DROP INDEX IDX_AC74095ACCFA12B8 ON activity');
        $this->addSql('IF EXISTS (SELECT * FROM sysobjects WHERE name = \'IDX_AC74095A419C3385\')
            ALTER TABLE activity DROP CONSTRAINT IDX_AC74095A419C3385
        ELSE
            DROP INDEX IDX_AC74095A419C3385 ON activity');
        $this->addSql('ALTER TABLE activity ADD status NVARCHAR(255) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL');
        $this->addSql('ALTER TABLE activity ADD type NVARCHAR(255) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL');
        $this->addSql('ALTER TABLE activity ADD profile NVARCHAR(255) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL');
        $this->addSql('ALTER TABLE activity DROP COLUMN profile_id');
        $this->addSql('ALTER TABLE activity DROP COLUMN pole_id');
    }
}
