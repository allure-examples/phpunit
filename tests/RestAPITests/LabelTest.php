<?php declare(strict_types=1);

namespace Allure\Examples\Tests\RestAPITests;

use PHPUnit\Framework\TestCase;
use Qameta\Allure\Allure;
use Qameta\Allure\StepContextInterface;
use Qameta\Allure\Attribute\DisplayName;
use Qameta\Allure\Attribute\Feature;
use Qameta\Allure\Attribute\Label;
use Qameta\Allure\Attribute\Tag;

#[
    Feature("Labels API"),
    Label("layer", "rest")
]
final class LabelTest extends TestCase
{
    #[
        Tag("smoke"),
        DisplayName("Create new label via API")
    ]
    public function testNewLabel(): void
    {
        $this->postNewLabel("hello");
        $this->assertLabel("hello");
    }

    #[
        Tag("regress"),
        DisplayName("Delete label via API")
    ]
    public function testDeleteLabel(): void
    {
        $this->postNewLabel("hello");
        $this->deleteLabel("hello");
        $this->assertNoLabel("hello");
    }

    function postNewLabel(string $title): void
    {
        Allure::runStep(
            function (StepContextInterface $step): void {
                Allure::addStep("POST /repos/:owner/:repo/labels");
            },
            "When I create new label with title $title via API"
        );
    }

    function deleteLabel(string $title): void
    {
        Allure::runStep(
            function (StepContextInterface $step) use($title) : void {
                $labelId = $this->findLabelByTitle($title);
                Allure::addStep("DELETE /repos/:owner/:repo/labels/$labelId");
            },
            "And I delete label with title $title via API"
        );
    }

    function assertLabel(string $title): void
    {
        $labelId = $this->findLabelByTitle($title);
        Allure::addStep("GET /repos/:owner/:repo/labels/$labelId");
        $this->assertTrue(true);
    }

    function assertNoLabel(string $title): void
    {
        $labelId = $this->findLabelByTitle($title);
        $this->assertTrue(true);
    }

    function findLabelByTitle(string $title): int
    {
        Allure::addStep("GET /repos/:owner/:repo/labels?text=$title");
        return random_int(1, 1000);
    }
}