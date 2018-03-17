<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180317124751 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_users (id INT AUTO_INCREMENT NOT NULL, id_roles INT DEFAULT NULL, username VARCHAR(25) DEFAULT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(60) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C2502824E7927C74 (email), INDEX IDX_C250282458BB6FF7 (id_roles), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE champs_clinique (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE csv_upload (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions (id INT AUTO_INCREMENT NOT NULL, id_test_video INT DEFAULT NULL, stop INT DEFAULT NULL, question VARCHAR(510) DEFAULT NULL, INDEX FK_questions_id_test_video (id_test_video), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponses (id INT AUTO_INCREMENT NOT NULL, id_questions INT DEFAULT NULL, reponse VARCHAR(510) DEFAULT NULL, juste TINYINT(1) DEFAULT NULL, INDEX IDX_1E512EC6AE9E8F2 (id_questions), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie (id INT AUTO_INCREMENT NOT NULL, id_categorie INT DEFAULT NULL, name VARCHAR(25) DEFAULT NULL, INDEX FK_sous_categorie_id_categorie (id_categorie), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, id_test_video INT DEFAULT NULL, score DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_32993751D293FCF0 (id_test_video), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, id_champs_clinique INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX FK_categorie_id_champs_clinique (id_champs_clinique), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) DEFAULT NULL, UNIQUE INDEX name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test_video (id INT AUTO_INCREMENT NOT NULL, id_souscategorie INT DEFAULT NULL, scenarios_name VARCHAR(50) DEFAULT NULL, video VARCHAR(50) DEFAULT NULL, INDEX IDX_77197C27D1DB7664 (id_souscategorie), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cas_clinique (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) DEFAULT NULL, UNIQUE INDEX name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_users ADD CONSTRAINT FK_C250282458BB6FF7 FOREIGN KEY (id_roles) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5D293FCF0 FOREIGN KEY (id_test_video) REFERENCES test_video (id)');
        $this->addSql('ALTER TABLE reponses ADD CONSTRAINT FK_1E512EC6AE9E8F2 FOREIGN KEY (id_questions) REFERENCES questions (id)');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BC9486A13 FOREIGN KEY (id_categorie) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751BF396750 FOREIGN KEY (id) REFERENCES app_users (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751D293FCF0 FOREIGN KEY (id_test_video) REFERENCES test_video (id)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6349E6346E5 FOREIGN KEY (id_champs_clinique) REFERENCES champs_clinique (id)');
        $this->addSql('ALTER TABLE test_video ADD CONSTRAINT FK_77197C27D1DB7664 FOREIGN KEY (id_souscategorie) REFERENCES sous_categorie (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751BF396750');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6349E6346E5');
        $this->addSql('ALTER TABLE reponses DROP FOREIGN KEY FK_1E512EC6AE9E8F2');
        $this->addSql('ALTER TABLE test_video DROP FOREIGN KEY FK_77197C27D1DB7664');
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BC9486A13');
        $this->addSql('ALTER TABLE app_users DROP FOREIGN KEY FK_C250282458BB6FF7');
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D5D293FCF0');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751D293FCF0');
        $this->addSql('DROP TABLE app_users');
        $this->addSql('DROP TABLE champs_clinique');
        $this->addSql('DROP TABLE csv_upload');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE reponses');
        $this->addSql('DROP TABLE sous_categorie');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE test_video');
        $this->addSql('DROP TABLE cas_clinique');
    }
}
