<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180314100419 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, id_test_video INT DEFAULT NULL, score DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_32993751D293FCF0 (id_test_video), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponses (id INT AUTO_INCREMENT NOT NULL, id_questions INT DEFAULT NULL, reponse TEXT DEFAULT NULL, INDEX IDX_1E512EC6AE9E8F2 (id_questions), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751BF396750 FOREIGN KEY (id) REFERENCES app_users (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751D293FCF0 FOREIGN KEY (id_test_video) REFERENCES test_video (id)');
        $this->addSql('ALTER TABLE reponses ADD CONSTRAINT FK_1E512EC6AE9E8F2 FOREIGN KEY (id_questions) REFERENCES questions (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE reponses');
    }
}
