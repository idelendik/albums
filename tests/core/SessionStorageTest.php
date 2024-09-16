<?php

declare(strict_types=1);

namespace Tests\core;

use Albums\core\SessionStorage;
use PHPUnit\Framework\TestCase;

class SessionStorageTest extends TestCase
{
    /** @test */
    public function put_adds_new_key()
    {
        $s = new SessionStorage([]);

        $this->assertFalse($s->has("some_key"));
        $s->put("some_key", "some_value");
        $this->assertTrue($s->has("some_key"));
        $this->assertEquals("some_value", $s->get("some_key"));
    }

    /** @test */
    public function put_replaces_existing_value()
    {
        $s = new SessionStorage(["some_key" => "some_value"]);

        $this->assertTrue($s->has("some_key"));
        $this->assertEquals("some_value", $s->get("some_key"));
        $s->put("some_key", "some_value_updated");
        $this->assertEquals("some_value_updated", $s->get("some_key"));
    }

    /** @test */
    public function has_returns_false_if_key_does_not_exist()
    {
        $s = new SessionStorage([]);

        $this->assertFalse($s->has("non_existing_key"));
    }

    /** @test */
    public function has_returns_true_if_key_exists()
    {
        $s = new SessionStorage(["existing_key" => "some_value"]);

        $this->assertTrue($s->has("existing_key"));
    }

    /** @test */
    public function get_returns_value_for_existing_key()
    {
        $s = new SessionStorage(["some_key" => "some_value"]);

        $this->assertEquals("some_value", $s->get("some_key"));
    }

    /** @test */
    public function get_returns_null_for_non_existing_key_without_default()
    {
        $s = new SessionStorage([]);

        $this->assertEquals(null, $s->get("some_key"));
    }

    /** @test */
    public function get_returns_default_value_for_non_existing_key_with_default()
    {
        $s = new SessionStorage([]);

        $storedValueOrDefault = $s->get("some_key", "some_default_value");

        $this->assertEquals("some_default_value", $storedValueOrDefault);
    }

    /** @test */
    public function remove_unsets_existing_key()
    {
        $s = new SessionStorage(["some_key" => "some_value"]);

        $s->remove("some_key");

        $this->assertCount(0, $s->all());
    }

    /** @test */
    public function remove_does_nothing_with_non_existing_key()
    {
        $s = new SessionStorage(["some_key" => "some_value"]);

        $s->remove("some_non_existing_key");

        $this->assertCount(1, $s->all());
    }

    /** @test */
    public function all_returns_empty_array_from_empty_storage()
    {
        $s = new SessionStorage([]);

        $this->assertEquals([], $s->all());
    }

    /** @test */
    public function all_returns_array_of_values_from_nonempty_storage()
    {
        $s = new SessionStorage(["some_key" => "some_value"]);

        $this->assertEquals(["some_key" => "some_value"], $s->all());
    }

    /** @test */
    public function clear_unsets_all_keys_in_the_storage()
    {
        $s = new SessionStorage(["some_key" => "some_value"]);

        $s->clear();

        $this->assertCount(0, $s->all());
    }
}