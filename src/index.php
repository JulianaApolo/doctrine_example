<?php

require("./scripts/util.inc.php") ;
require("./scripts/init.inc.php") ;

try {
    //Inicia transação. Se tudo ok, o flush e o commit são feitos.
    $entityManager->transactional(function ($entityManager) {
        $faker = Faker\Factory::create("pt_BR");
        
        //Cria marca
        $data = [
            "description" => ucfirst($faker->word),
            // "creationDate" => new DateTime("now"),
            // "modificationDate" => new DateTime("now")
        ];
        $brand = new Brand();
        $brand->populate($data);
        $entityManager->persist($brand);

        printf("Marca <b>%s</b> criada<br>", $brand->getDescription());

        //Cria o modelo
        $data = [
            "description" => ucfirst($faker->word),
            "brand" => $brand,
            // "creationDate" => new DateTime("now"),
            // "modificationDate" => new DateTime("now")
        ];
        $model = new Model();
        $model->populate($data);
        $entityManager->persist($model);

        printf("Modelo <b>%s</b> criado<br>", $model->getDescription());

        //Cria o cliente
        $data = [
            "name" => sprintf("%s %s", $faker->firstName, $faker->lastName),
            // "creationDate" => new DateTime("now"),
            // "modificationDate" => new DateTime("now")
        ];
        $customer = new Customer();
        $customer->populate($data);
        $entityManager->persist($customer);

        printf("Cliente <b>%s</b> criado<br>", $customer->getName());

        //Cria o veiculo
        $data = [
            "licensePlate" => strtoupper($faker->bothify("???####")),
            "model" => $model,
            "creationDate" => new DateTime("now"),
            // "modificationDate" => new DateTime("now")
        ];
        $vehicle = new Vehicle();
        $vehicle->populate($data);
        $entityManager->persist($vehicle);

        printf("Veículo <b>%s</b> criado<br>", $vehicle->getLicensePlate());

        //Aluguel
        $data = [
            "vehicle" => $vehicle,
            "customer" => $customer,
            "rentDate" => new DateTime("now"),
            // "creationDate" => new DateTime("now"),
            // "modificationDate" => new DateTime("now")
        ];
        $rent = new Rent();
        $rent->populate($data);
        $entityManager->persist($rent);

        printf("Aluguel para o cliente <b>%s</b> e veículo <b>%s</b> efetuado<br>", $customer->getName(), $vehicle->getLicensePlate());
    });

    $brand = $entityManager->find('Brand', 2);
    $brand->setDescription("teste");
    $entityManager->persist($brand);
    $entityManager->flush();

} catch (\Exception $e) {
    print($e);
}