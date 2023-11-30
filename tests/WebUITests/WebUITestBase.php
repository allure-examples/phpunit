<?php declare(strict_types=1);

namespace Allure\Examples\Tests\WebUITests;

use Exception;
use PHPUnit\Framework\TestCase;

abstract class WebUITestBase extends TestCase
{
    protected function maybeThrowElementNotFound(): void
    {
        if (random_int(0, 5) == 0)
        {
            throw new Exception(
                "Element not found for xpath [//div[@class='something']]"
            );
        }
    }

    protected function maybeThrowAssertionError(string $text): void
    {
        if (random_int(0, 3) == 0)
        {
            $this->assertTrue(false, $text);
        }

        $this->assertTrue(true);
    }
}