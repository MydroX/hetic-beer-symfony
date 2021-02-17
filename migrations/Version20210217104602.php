<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217104602 extends AbstractMigration
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
        $this->addSql('ALTER TABLE statistic DROP INDEX UNIQ_649B469C19EB6921, ADD INDEX IDX_649B469C19EB6921 (client_id)');
        $this->addSql('ALTER TABLE statistic DROP INDEX UNIQ_649B469CD0989053, ADD INDEX IDX_649B469CD0989053 (beer_id)');
        $this->addSql('ALTER TABLE statistic CHANGE beer_id beer_id INT NOT NULL, CHANGE client_id client_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistic DROP INDEX IDX_649B469CD0989053, ADD UNIQUE INDEX UNIQ_649B469CD0989053 (beer_id)');
        $this->addSql('ALTER TABLE statistic DROP INDEX IDX_649B469C19EB6921, ADD UNIQUE INDEX UNIQ_649B469C19EB6921 (client_id)');
        $this->addSql('ALTER TABLE statistic CHANGE beer_id beer_id INT DEFAULT NULL, CHANGE client_id client_id INT DEFAULT NULL');
    }
}
