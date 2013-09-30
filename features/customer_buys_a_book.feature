Feature: as a customer
    in order to read a book online
    i want to be able to purchase it and receive it online

    Scenario: customer orders and receives a book
        Given customer specifies the book she wants
        Then customer is sent to third-party site
        When customer fills in info at third-party site and submits
        Then customer is redirected to former site
        And customer finishes order and receives book
