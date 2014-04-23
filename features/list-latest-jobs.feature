Feature: List latest active jobs
    In order to find a job offer
    As a user
    I need to see the list of the most recent active jobs ordered by category and creation date

    Scenario: Only one category has job offers
        Given there is a category "Programming"
        And there is a job offer posted in "2014-01-01" under the "Programming" category
        And there is a job offer posted in "2014-04-04" under the "Programming" category
        Then I should see the job posted in "2014-04-04" under the "Programming" category first
    Scenario: Job offers in two different categories
        Given there is a category "Programming"
        And there is a job offer posted in "2014-01-01" under the "Programming" category
        And there is a job offer posted in "2014-04-04" under the "Programming" category
        Given there is a category "Design"
        And there is a job offer posted in "2014-01-01" under the "Design" category
        And there is a job offer posted in "2014-04-04" under the "Design" category
        Then I should see the job posted in "2014-04-04" under the "Design" category first
