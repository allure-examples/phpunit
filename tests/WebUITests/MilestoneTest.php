<?php declare(strict_types=1);

namespace Allure\Examples\Tests\WebUITests;

use Qameta\Allure\Allure;
use Qameta\Allure\StepContextInterface;
use Qameta\Allure\Attribute\DisplayName;
use Qameta\Allure\Attribute\Feature;
use Qameta\Allure\Attribute\Tag;

#[Feature("Milestones UI")]
final class MilestoneTest extends WebUITestBase
{
    #[DisplayName("Create new milestone by authorized user")]
    #[Tag("regress")]
    #[Tag("smoke")]
    public function testCreateNewMilestoneByAuthorizedUser(): void
    {
        Allure::runStep([$this, "openMilestonesPage"]);
        $this->createMilestone("hello");
        $this->assertMilestone("hello");
    }

    #[DisplayName("Close existing milestone by authorized user")]
    #[Tag("regress")]
    public function testCloseMilestoneByAuthorizedUser(): void
    {
        Allure::runStep([$this, "openMilestonesPage"]);
        $this->createMilestone("hello");
        $this->closeMilestone("hello");
        $this->assertNoMilestone("hello");
    }

    #[DisplayName("When I open milestones page")]
    function openMilestonesPage(): void
    {
    }

    function createMilestone(string $title): void
    {
        Allure::addStep("And I create milestone with title $title");
    }

    function closeMilestone(string $title): void
    {
        Allure::addStep("And I close milestone with title $title");
    }

    function assertMilestone(string $title): void
    {
        Allure::runStep(
            function (StepContextInterface $step): void {
                $this->assertTrue(true);
            },
            "Then I should see milestone with title $title"
        );
    }

    function assertNoMilestone(string $title): void
    {
        Allure::runStep(
            function (StepContextInterface $step): void {
                $this->assertTrue(true);
            },
            "Then I should not see milestone with title $title"
        );
    }
}