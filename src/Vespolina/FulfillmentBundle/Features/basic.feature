Feature: Product Fulfillment
  In_order_to fulfill a product
  As_a e-commerce framework
  I_need_to_be_able_to manage fulfillment 

Background:
  Given I create a fulfillment order on a product

Scenario: init fulfillment status
   Then I should see fulfillment order of this product initialized

Scenario: set fulfillment status
   When I set status of the fulfillment order to "processing"
   Then I should read back "processing" for status

Scenario: read fulfillment status
   When I set status of the fulfillment order to "fulfilled"
   Then I should read back "fulfilled" for status

#Scenario: get fulfillment order preview
#   When I get the fulfillment service
#    And I invoke to display fulfillment preview for a given order
#   Then I get a information about possible fulfillment

#Scenario: create fulfillment order
#   When I get the fulfillment service
#    And I invoke to crate a Fulfillment Order
#   Then I get a confirmation that Fulfillment Order was created

#Scenario: get fulfillment order
#   When I get the fulfillment service
#    And I invoke to get a specific Fulfillment Order
#   Then I get a all information about this specific Fulfillment Order

#Scenario: cancel fulfillment order
#   When I get the fulfillment service
#    And I invoke to cancel a Fulfillment Order
#   Then I get a confirmation that the Order was cancelled
