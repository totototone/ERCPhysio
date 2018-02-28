<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180228125524 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_C2502824F85E0677 ON app_users');
        $this->addSql('ALTER TABLE app_users ADD id_roles INT DEFAULT NULL, ADD role INT DEFAULT NULL, CHANGE username username VARCHAR(25) DEFAULT NULL');
        $this->addSql('ALTER TABLE app_users ADD CONSTRAINT FK_C250282458BB6FF7 FOREIGN KEY (id_roles) REFERENCES roles (id)');
        $this->addSql('CREATE INDEX IDX_C250282458BB6FF7 ON app_users (id_roles)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_users DROP FOREIGN KEY FK_C250282458BB6FF7');
        $this->addSql('DROP INDEX IDX_C250282458BB6FF7 ON app_users');
        $this->addSql('ALTER TABLE app_users DROP id_roles, DROP role, CHANGE username username VARCHAR(25) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2502824F85E0677 ON app_users (username)');
    }
}
