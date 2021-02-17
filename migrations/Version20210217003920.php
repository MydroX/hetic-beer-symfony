<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217003920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function isTransactional(): bool
    {
        return false;
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, weight DOUBLE PRECISION DEFAULT NULL, name VARCHAR(100) NOT NULL, beer_number_purchased INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistic (id INT AUTO_INCREMENT NOT NULL, beer_id INT DEFAULT NULL, client_id INT DEFAULT NULL, score INT NOT NULL, UNIQUE INDEX UNIQ_649B469CD0989053 (beer_id), UNIQUE INDEX UNIQ_649B469C19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CD0989053 FOREIGN KEY (beer_id) REFERENCES beer (id)');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469C19EB6921');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE statistic');
    }
}
