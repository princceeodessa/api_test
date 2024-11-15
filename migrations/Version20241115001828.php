<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241115001828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Rename table from `table` to `tables`';
    }

    public function up(Schema $schema): void
    {

        $this->addSql('RENAME TABLE `table` TO `tables`');
    }

}