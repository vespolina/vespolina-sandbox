Feature: Product Fulfillment
  In_order_to fulfill a product
  As_a e-commerce framework
  I_need_to_be_able_to manage fulfillment 

Background:
  Given I have an order on a product
   When I configure the fulfillment of this product

Scenario: init fulfillment status
   Then I should see fulfillment of this product initialized

Scenario: set fulfillment status
   When I set status to processing
   Then I should read back "processing" for status

Scenario: read fulfillment status
   When I set status to "processing"
   Then I should read back "processing" for status
   When I set status to "fulfilled"
   Then I should read back "processing" for status
