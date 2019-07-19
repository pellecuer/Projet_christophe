<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190719124415 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EE5E237E06 ON project (name) WHERE name IS NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EE77153098 ON project (code) WHERE code IS NOT NULL');
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
        $this->addSql('IF EXISTS (SELECT * FROM sysobjects WHERE name = \'UNIQ_2FB3D0EE5E237E06\')
            ALTER TABLE project DROP CONSTRAINT UNIQ_2FB3D0EE5E237E06
        ELSE
            DROP INDEX UNIQ_2FB3D0EE5E237E06 ON project');
        $this->addSql('IF EXISTS (SELECT * FROM sysobjects WHERE name = \'UNIQ_2FB3D0EE77153098\')
            ALTER TABLE project DROP CONSTRAINT UNIQ_2FB3D0EE77153098
        ELSE
            DROP INDEX UNIQ_2FB3D0EE77153098 ON project');
    }
}
