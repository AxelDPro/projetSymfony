<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321141114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE biens ADD nb_pieces INT DEFAULT NULL, ADD nb_chambre INT NOT NULL, ADD image VARCHAR(300) NOT NULL, DROP nbPieces, DROP nbChambre, CHANGE titre titre VARCHAR(200) DEFAULT NULL, CHANGE description description VARCHAR(200) DEFAULT NULL, CHANGE surface surface INT NOT NULL, CHANGE etage etage INT NOT NULL, CHANGE ville ville VARCHAR(200) NOT NULL, CHANGE adresse adresse VARCHAR(200) NOT NULL, CHANGE cp cp VARCHAR(100) NOT NULL, CHANGE type type VARCHAR(200) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE biens ADD nbChambre INT DEFAULT NULL, DROP nb_chambre, DROP image, CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE description description TEXT DEFAULT NULL, CHANGE etage etage INT DEFAULT NULL, CHANGE ville ville VARCHAR(100) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE cp cp VARCHAR(10) DEFAULT NULL, CHANGE type type VARCHAR(50) DEFAULT NULL, CHANGE surface surface INT DEFAULT NULL, CHANGE nb_pieces nbPieces INT DEFAULT NULL');
    }
}
