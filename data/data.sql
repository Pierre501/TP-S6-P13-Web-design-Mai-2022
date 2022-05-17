-- create database rechauffement_climatique;
-- grant all privileges on database rechauffement_climatique to admin;
-- psql -d rechauffement_climatique -U admin -W


create extension pgcrypto;


create table if not exists administrateur(
	id_administrateur int not null,
	username varchar(100) not null,
	mot_de_passe varchar(100) not null,
	primary key(id_administrateur)
);
insert into administrateur values(1, 'administrateur@gmail.com', encode(digest('Admin2022!','sha1'),'hex'));


create table if not exists consequence(
	id_consequence int not null,
	type_consequence varchar(100) not null,
	primary key(id_consequence)
);
insert into consequence values(1, E'Consequences sur l\'ecosysteme et la planete');
insert into consequence values(2, E'Consequences sur la societe et l\'economie');
insert into consequence values(3, E'Consequences sur les entreprises');


create table if not exists details_consequence(
	id_details_consequence serial not null,
	id_consequence int not null,
	details_consequence varchar(1000),
	primary key(id_details_consequence),
	foreign key(id_consequence) references consequence(id_consequence)
);

insert into details_consequence values(default, 1, E'D\'abord, une augmentation des températures à cause du <strong>rechauffement climatique</strong> affecte l\’ensemble de l\’écosystème mondial et pas seulement la chaleur ressentie. La météo s\’en trouve perturbée, avec une augmentation des phénomènes météorologiques extrêmes, des changements des modèles météorologiques habituels. Cela veut dire plus de tempêtes, plus d\’inondations, plus de cyclones et de sécheresses.');
insert into details_consequence values(default, 2, E'Sur la société et l\’économie, le <strong>rechauffement climatique</strong> peut avoir potentiellement plusieurs conséquences : la capacité des sociétés à s\’adapter à un nouveau climat, à adapter leurs infrastructures, notamment médicales, mais aussi leurs bâtiments. Le <strong>rechauffement climatique</strong> aura aussi des conséquences sur la santé publique, la capacité alimentaire des pays…');
insert into details_consequence values(default, 3, E'La modification des éco-systèmes et des ressources, la multiplication des catastrophes naturelles, la transformation des modèles climatiques, les changements dans la réglementation et L\’image de l\’entreprise face aux enjeux environnementaux.');


create table if not exists facteurs(
	id_facteurs serial not null,
	facteurs varchar(100) not null,
	url varchar(100) not null,
	images varchar(100) default null,
	consequence int not null,
	primary key(id_facteurs),
	foreign key(consequence) references consequence(id_consequence)
);
insert into facteurs values(default, 'Gag a effet de serre', 'Gag-a-effet-de-serre-1.html', 'images-facteur1.jpg', 1);
insert into facteurs values(default, 'Aerosols et nuages', 'Aerosols-et-nuages-2.html', 'images-facteur2.jpg', 2);
insert into facteurs values(default, 'Retroaction climatique', 'Retroaction-climatique-3.html', 'images-facteur3.jpg', 3);



create view view_consequence as select
	consequence.id_consequence,
	consequence.type_consequence,
	details_consequence.id_details_consequence,
	details_consequence.details_consequence
from consequence join details_consequence on consequence.id_consequence = details_consequence.id_consequence;


drop view view_consequence;
drop table facteurs;
drop table details_consequence;
drop table consequence;



