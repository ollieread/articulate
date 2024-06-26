<?php

namespace Articulate\Metadata\Attributes;

use Articulate\Contracts\Enrichment;
use Articulate\Metadata\MetadataBuilder;
use Attribute;

/**
 * Entity
 *
 * This attribute marks a class as an entity for the purpose of metadata.
 *
 * @package Metadata
 */
#[Attribute(Attribute::TARGET_CLASS)]
final readonly class Entity implements Enrichment
{
    public string $table;

    public ?string $connection;

    public function __construct(string $table, ?string $connection = null)
    {
        $this->table      = $table;
        $this->connection = $connection;
    }

    /**
     * Enrich the metadata
     *
     * @template MetaClass of object
     *
     * @param \Articulate\Metadata\MetadataBuilder<MetaClass> $metadata
     *
     * @return void
     */
    public function enrich(MetadataBuilder $metadata): void
    {
        // Mark the class as an entity
        $metadata->entity();

        // Set the table name
        $metadata->table($this->table);

        // If there's a connection, we'll set that too
        if ($this->connection !== null) {
            $metadata->connection($this->connection);
        }
    }
}
