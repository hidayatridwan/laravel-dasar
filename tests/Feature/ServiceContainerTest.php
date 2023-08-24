<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Tests\TestCase;

use function PHPUnit\Framework\assertSame;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        $foo1 = $this->app->make(Foo::class); // new Foo()
        $foo2 = $this->app->make(Foo::class); // new Foo()

        self::assertSame("Foo", $foo1->foo());
        // self::assertNotSame($foo1, $foo2); //before register in service provider
        self::assertSame($foo1, $foo2);
    }

    public function testBind()
    {
        // $person = $this->app->make(Person::class);
        // var_dump($person);

        $this->app->bind(Person::class, function () {
            return new Person("ridwan", "hidayat");
        });

        $person1 = $this->app->make(Person::class); // new Person("ridwan", "hidayat");
        $person2 = $this->app->make(Person::class); // new Person("ridwan", "hidayat");

        self::assertSame("ridwan", $person1->firstName);
        self::assertSame("ridwan", $person1->firstName);

        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function () {
            return new Person("ridwan", "hidayat");
        });

        $person1 = $this->app->make(Person::class); // new Person("ridwan", "hidayat");
        $person2 = $this->app->make(Person::class); // return existing

        self::assertSame("hidayat", $person1->lastName);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("ridwan", "hidayat");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person

        self::assertSame("hidayat", $person1->lastName);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {
        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        // self::assertNotSame($foo, $bar->foo); // before registered service providers
        self::assertSame($foo, $bar->foo);

        $this->app->singleton(Foo::class, function () {
            return new Foo();
        });

        $foo2 = $this->app->make(Foo::class);
        $bar2 = $this->app->make(Bar::class);
        $bar3 = $this->app->make(Bar::class);

        // self::assertSame($foo2, $bar2->foo); // before register service provider
        self::assertNotSame($foo2, $bar2->foo);
        // self::assertNotSame($bar2, $bar3); // before register service provider
        self::assertSame($bar2, $bar3);

        $this->app->singleton(Bar::class, function () {
            return new Bar($this->app->make(Foo::class));
        });
        $bar4 = $this->app->make(Bar::class);
        $bar5 = $this->app->make(Bar::class);

        self::assertSame($bar4, $bar5);
    }

    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, function () {
        //     return new HelloServiceIndonesia();
        // });

        // or 

        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);
        $helloService = $this->app->make(HelloService::class);

        assertSame("Hello Ridwan", $helloService->hello("Ridwan"));
    }
}
