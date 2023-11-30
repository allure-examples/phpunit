<?php declare(strict_types=1);

namespace Allure\Examples\Tests\WebUITests;

use Qameta\Allure\Allure;
use Qameta\Allure\StepContextInterface;
use Qameta\Allure\Attribute\DisplayName;
use Qameta\Allure\Attribute\Feature;
use Qameta\Allure\Attribute\Tag;

#[Feature("Labels UI")]
final class LabelTest extends WebUITestBase
{
    #[
        DisplayName("Create new label by authorized user"),
        Tag("regress")
    ]
    public function testLabelCreatedByauthorizedUser(): void
    {
        $this->openLabelsPage();
        $this->createLabel("hello");
        $this->assertLabel("hello");
    }

    #[
        DisplayName("Add label to existing issue by authorized user"),
        Tag("smoke")
    ]
    public function testLabelAddedToExistingIssue(): void
    {
        $issueId = random_int(1, 1000);
        $this->openIssuePage($issueId);
        $this->addLabelToIssue($issueId, "hello");
        $this->openIssuesPage();
        $this->filterIssuesByLabel("hello");
        $this->assertIssueWithLabel($issueId, "hello");
    }

    #[
        DisplayName("Delete existing label by authorized user"),
        Tag("smoke")
    ]
    public function testLabelDeletedByAuthorizedUser(): void
    {
        $this->openLabelsPage();
        $this->createLabel("hello");
        $this->deleteLabel("hello");
        $this->assertNoLabel("hello");
    }

    function openLabelsPage(): void
    {
        Allure::runStep(
            function (StepContextInterface $step): void
            {
                $this->maybeThrowElementNotFound();
            },
            "When I open labels page"
        );
    }

    function openIssuePage(int $issueId): void
    {
        Allure::runStep(
            function (StepContextInterface $step): void
            {
                $this->maybeThrowElementNotFound();
            },
            "When I open issue with id $issueId"
        );
    }

    function createLabel(string $title): void
    {
        Allure::runStep(
            function (StepContextInterface $step): void
            {
                $this->maybeThrowElementNotFound();
            },
            "And I create label with title $title"
        );
    }

    function addLabelToIssue(int $issueId, string $labelTitle): void
    {
        Allure::runStep(
            function (StepContextInterface $step): void
            {
                $this->maybeThrowElementNotFound();
            },
            "And I add label with title $labelTitle to issue $issueId"
        );
    }

    function openIssuesPage(): void
    {
        Allure::runStep(
            function (StepContextInterface $step): void
            {
                $this->maybeThrowElementNotFound();
            },
            "And I open issues page"
        );
    }

    function filterIssuesByLabel(string $labelTitle): void
    {
        Allure::runStep(
            function (StepContextInterface $step): void
            {
                $this->maybeThrowElementNotFound();
            },
            "And I filter issues by label $labelTitle"
        );
    }

    function deleteLabel(string $labelTitle): void
    {
        Allure::runStep(
            function (StepContextInterface $step): void
            {
                $this->maybeThrowElementNotFound();
            },
            "And I delete label with title $labelTitle"
        );
    }

    function assertLabel(string $labelTitle): void
    {
        Allure::runStep(
            function (StepContextInterface $step) use($labelTitle): void
            {
                $this->assertTrue(true);
            },
            "Then I should see label with title $labelTitle"
        );
    }

    function assertIssueWithLabel(int $issueId, string $labelTitle): void
    {
        Allure::runStep(
            function (StepContextInterface $step) use($issueId, $labelTitle): void
            {
                $this->maybeThrowAssertionError(
                    "No issue $issueId in list filtered by $labelTitle label"
                );
            },
            "Then I should see issue with label title $labelTitle"
        );
    }

    function assertNoLabel(string $labelTitle): void
    {
        Allure::runStep(
            function (StepContextInterface $step) use($labelTitle): void
            {
                $this->maybeThrowAssertionError(
                    "Label $labelTitle still exists"
                );
            },
            "Then I should not see label with title $labelTitle"
        );
    }
}