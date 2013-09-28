Feature: customer can buy book paying with paypal

    Scenario: customer orders and receives a book
        Given customer adds book to cart
        And customer starts checkout process
        When customer clicks buy
        Then customer will be sent to paypal fill info and sent back
        And customer finishes order and receives book
