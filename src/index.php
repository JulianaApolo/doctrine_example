<?php

require("./scripts/util.inc.php");
require("./scripts/init.inc.php");

use Models\Brand;
use Models\Customer;
use Models\Model;
use Models\Rent;
use Models\Vehicle;

$faker = Faker\Factory::create("pt_BR");

try {
    //Inicia transação. Se tudo ok, o flush e o commit são feitos.
    $entityManager->transactional(function ($entityManager) use ($faker) {
        
        
        //Cria marca
        $data = [
            "description" => ucfirst($faker->word)
        ];
        $brand = new Brand();
        $brand->populate($data);
        $entityManager->persist($brand);

        printf("Marca <b>%s</b> criada<br>", $brand->getDescription());

        //Cria o modelo
        $data = [
            "description" => ucfirst($faker->word),
            "brand" => $brand
        ];
        $model = new Model();
        $model->populate($data);
        $entityManager->persist($model);

        printf("Modelo <b>%s</b> criado<br>", $model->getDescription());

        //Cria o cliente
        $data = [
            "name" => sprintf("%s %s", $faker->firstName, $faker->lastName)
        ];
        $customer = new Customer();
        $customer->populate($data);
        $entityManager->persist($customer);

        printf("Cliente <b>%s</b> criado<br>", $customer->getName());

        //Cria o veiculo
        $data = [
            "licensePlate" => strtoupper($faker->bothify("???####")),
            "model" => $model,
            "creationDate" => new \DateTime("now")
        ];
        $vehicle = new Vehicle();
        $vehicle->populate($data);
        $entityManager->persist($vehicle);

        printf("Veículo <b>%s</b> criado<br>", $vehicle->getLicensePlate());

        //Aluguel
        $data = [
            "vehicle" => $vehicle,
            "customer" => $customer,
            "rentDate" => new \DateTime("now")
        ];
        $rent = new Rent();
        $rent->populate($data);
        $entityManager->persist($rent);

        printf("Aluguel para o cliente <b>%s</b> e veículo <b>%s</b> efetuado<br>", $customer->getName(), $vehicle->getLicensePlate());
    });

    $brand = $entityManager->find('Models\Brand', 1);
    $oldName = $brand->getDescription();
    $newName = ucfirst($faker->word);
    $brand->setDescription($newName);
    $entityManager->persist($brand);
    $entityManager->flush();

    printf("Marca <b>%s</b> alterada para <b>%s</b><br>", $oldName, $newName);
} catch (\Exception $e) {
    print($e);
}
