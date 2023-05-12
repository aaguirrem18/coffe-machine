# Coffee Machine

Coffee Machine is an awesome console application that from a few input parameters (drink type, amount of money, number of sugars, extra hot check) is capable to order a drink and show a cool message of the desired drink.

## How it works

Command
```
app:order-drink 

```

Arguments

|#|Name|Type|Required|Description|Values|Default|
|---|---|---|---|---|---|---|
|1|drinkType|string|true|Type of drink|tea, coffee, chocolate|
|2|money|float|true|Amount of money given by the user in unit of currency||
|3|sugars|int|false|Number of sugars|0, 1, 2|0|

Options

|Name|Type|Required|Description|Values|Default|
|---|---|---|---|---|---|
|extraHot (--extra-hot, -e)| |false|Flag indicating if the user wants extra hot drink|true, false|false|

List prices

|Drink|Price|
|---|---|
|Tea|0.4|
|Coffee|0.5|
|Chocolate|0.6|

Validations
* If the drink type is not *tea*, *coffee* or *chocolate*, it shows the following message:
```
The drink type should be tea, coffee or chocolate.
```
* If the amount of money does not reach the price of the drink, a message as the following is displayed:
```
The tea costs 0.4.
```
* If the number of sugars is not between 0 and 2, it shows a message like this:
```
The number of sugars should be between 0 and 2.
```
* If the arguments are right, the displayed message is:
```
You have ordered a coffee
```
* If the number of sugars is greater than 0, it includes the stick to the drink and it shows a message similar tot this:
```
You have ordered a coffee with 2 sugars (stick included).
```
* If it adds extra hot option, the displayed message will be:
```
You have ordered a coffee extra hot with 2 sugars (stick included)    
```

* Clean code
* SOLID principles
* Decoupling
* Design patterns
* Error handling
* Unit testing
* TDD
* Hexagonal architecture


## Project set up

Install and run the application.
```
git clone git@gitlab.com:adsmurai/recruitment/coffee-machine.git
cd coffee-machine
docker/composer install
docker/up
```

Examples of the use of the application.
```
docker/console app:order-drink tea 0.5 1 -e
docker/console app:order-drink coffee 0.5
docker/console app:order-drink chocolate 1 --extra-hot
```

Use of Billing Command.
```
docker/console app:money-earned
```

Run tests
```
docker/test
```
