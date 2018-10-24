## Battle Simulator

Determines a battle outcome based on probability calculations

##### Requirements
* PHP 7.2+

##### Installation
* Copy or clone the repository
* Install the required packages
~~~
    composer install 
~~~


##### Description and usage

File *index.php* in the top level directory of the project serves as an entry point and  initiates the simulation run.

Once the simulator is started all the army squads will start attacking each other until there is only one army left.

Squads are consisted out of a number of units (soldiers or vehicles), that behave as a coherent group.
A squad is active as long as it contains an active unit.

Each unit represents either a soldier or a vehicle manned by a predetermined number of soldiers.

Each time a squad attacks it chooses a target squad, depending on the chosen strategy:

* random - attack any random squad
* weakest - attack the weakest opposing squad
* strongest - attack the strongest opposing squad

The initial composition of armies is set in the configuration file **battle_config.json**, placed in the top level directory.

Editing this file allows to manually adjust the number of armies taking part in the battle, strategy and unit consistency of each army.

The outcome of each battle is being logged in the separate file and can be found in
```
storage/logs/battle_logs
```
