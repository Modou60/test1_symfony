<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211123083211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auteurs_articles (auteurs_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_DE9B259CAE784107 (auteurs_id), INDEX IDX_DE9B259C1EBAF6CC (articles_id), PRIMARY KEY(auteurs_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaires (id INT AUTO_INCREMENT NOT NULL, auteur_id INT DEFAULT NULL, mail VARCHAR(255) NOT NULL, date DATE NOT NULL, commentaire LONGTEXT NOT NULL, INDEX IDX_D9BEC0C460BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auteurs_articles ADD CONSTRAINT FK_DE9B259CAE784107 FOREIGN KEY (auteurs_id) REFERENCES auteurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE auteurs_articles ADD CONSTRAINT FK_DE9B259C1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C460BB6FE6 FOREIGN KEY (auteur_id) REFERENCES utilisateurs (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteurs_articles DROP FOREIGN KEY FK_DE9B259CAE784107');
        $this->addSql('DROP TABLE auteurs');
        $this->addSql('DROP TABLE auteurs_articles');
        $this->addSql('DROP TABLE commentaires');
    }
}
