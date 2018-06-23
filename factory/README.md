There are two possible benefits to building your code this way; 

the first is that if you need to change, rename, or replace the Automobile class later on you can do so and you will only have to modify the code in the factory, instead of every place in your project that uses the Automobile class. 

The second possible benefit is that if creating the object is a complicated job you can do all of the work in the factory, instead of repeating it every time you want to create a new instance.

There are three variations of the factory pattern:

1. Simple Factory Pattern. This allows interfaces for creating objects without exposing the object creation logic to the client.

2. Factory Method Pattern. This allows interfaces for creating objects, but allow subclasses to determine which class to instantiate.

3. Abstract Factory Pattern. Unlike the above two patterns, an abstract factory is an interface to create of related objects without specifying/exposing their classes. We can also say that it provides an object of another factory that is responsible for creating required objects.