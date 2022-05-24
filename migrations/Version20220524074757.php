<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220524074757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add company field on Question';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE question ADD company VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE question DROP company');
    }
}
