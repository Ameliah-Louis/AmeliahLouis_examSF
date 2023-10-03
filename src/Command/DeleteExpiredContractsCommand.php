<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'DeleteExpiredContractsCommand',
    description: 'Commande réservé aux admin pour delete tous les employés dont le contrat est terminé.',
)]
class DeleteExpiredContractsCommand extends Command
{
    protected static $defaultName = 'app:delete-expired-contracts';

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $contracts = $this->entityManager->getRepository('App:Contract')
            ->findBy(['ContractEnd' => '<', date('Y-m-d')]);

        foreach ($contracts as $contract) {
            $this->entityManager->remove($contract);
        }

        $this->entityManager->flush();

        $output->writeln('Les contrats expirés ont été supprimés');

        return 0;
    }
}

// J'ai pas réussi à la testé puisque je n'arrive pas à la remplir automatiquement avec mes fixtures.
// Du coup j'ai juste écris ça via différentes recherches mais j'ai pas du tout débuggé.

