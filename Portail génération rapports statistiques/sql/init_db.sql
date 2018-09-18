/* ---------------------------------------------------------------------------------------------*/
/*      Création de la procédure permettant supprimer toutes les tables du schema public        */
/* ---------------------------------------------------------------------------------------------*/
CREATE OR REPLACE FUNCTION drop_all() RETURNS VOID AS $$
DECLARE
	tables RECORD;
        contraintes RECORD;

BEGIN

        -- Parcours et suppression de toutes les contraintes des table du schema public       
        FOR contraintes IN SELECT * FROM information_schema.table_constraints WHERE table_schema = 'public' AND constraint_type = 'FOREIGN KEY' LOOP
            
            EXECUTE 'ALTER TABLE ' || contraintes.table_schema || '.' || contraintes.table_name || ' DROP CONSTRAINT ' || contraintes.constraint_name;

        END LOOP;

        -- Parcours et suppression de toutes les tables du schema public
	FOR tables IN SELECT table_schema, table_name from information_schema.tables where table_schema in ('public') LOOP
	
		RAISE INFO 'DROP TABLE : % % ', tables.table_schema, tables.table_name;	
		EXECUTE 'DROP TABLE ' || tables.table_schema || '.' || tables.table_name;
			
	END LOOP;

END;
$$ LANGUAGE 'plpgsql';


/* ---------------------------------------------------------------------------------------------*/
/*                        Execution de la fonction de suppression                               */
/* ---------------------------------------------------------------------------------------------*/
SELECT drop_all();

/* ---------------------------------------------------------------------------------------------*/
/*                       Suppression de la fonction de suppression                              */
/* ---------------------------------------------------------------------------------------------*/
DROP FUNCTION drop_all();

/* ---------------------------------------------------------------------------------------------*/
/*                      Initialisation du schéma de la base de données                          */
/* ---------------------------------------------------------------------------------------------*/

/* Table contenant les valeurs des différents paramètres de la plateforme */
CREATE TABLE apobi_params (
    pa_code CHARACTER VARYING(50) NOT NULL PRIMARY KEY,
    pa_valeur TEXT
);
COMMENT ON TABLE apobi_params IS 'Table contenant les valeurs des différents paramètres de la plateforme';

/* Table contenant la liste des différents types de base de données auxquels peux se connecter le portail */
CREATE TABLE apobi_type_database (
    id_apobi_type_database SERIAL NOT NULL PRIMARY KEY,
    tdb_code CHARACTER VARYING(10) UNIQUE NOT NULL,
    tdb_libelle CHARACTER VARYING(150) NOT NULL,
    tdb_lswa BOOLEAN NOT NULL,
    tdb_dwh BOOLEAN NOT NULL
);
COMMENT ON TABLE apobi_type_database IS 'Table contenant la liste des différents types de base de données auxquels peux se connecter le portail';

/* Table contenant la description des types de données utilisables dans les invites et sur le portail */
CREATE TABLE apobi_type_donnee (
    id_apobi_type_donnee SERIAL NOT NULL PRIMARY KEY,
    tdo_code CHARACTER VARYING(10) NOT NULL,
    tdo_libelle CHARACTER VARYING(150) NOT NULL
);
COMMENT ON TABLE apobi_type_donnee IS 'Table contenant la description des types de données utilisables dans les invites et sur le portail';

/* Table contenant la description des invites prédéfinies, utilisables dans les rapports */
CREATE TABLE apobi_invite (
    id_apobi_invite SERIAL NOT NULL PRIMARY KEY,
    fk_apobi_type_database INTEGER NOT NULL REFERENCES apobi_type_database(id_apobi_type_database),
    fk_apobi_type_donnee INTEGER NOT NULL REFERENCES apobi_type_donnee(id_apobi_type_donnee),
    in_code CHARACTER VARYING(50) UNIQUE NOT NULL,
    in_libelle CHARACTER VARYING(150) NOT NULL,    
    in_requete TEXT    
);
COMMENT ON TABLE apobi_invite IS 'Table contenant la description des invites prédéfinies, utilisables dans les rapports';

/* Table contenant la description des rapports disponibles sur la plateforme*/
CREATE TABLE apobi_rapport (
    id_apobi_rapport SERIAL NOT NULL PRIMARY KEY,
    fk_apobi_type_database INTEGER NOT NULL REFERENCES apobi_type_database(id_apobi_type_database),
    ra_code CHARACTER VARYING(50) NOT NULL,    
    ra_libelle CHARACTER VARYING(150),
    ra_tarif NUMERIC,
    ra_nom_wdetat CHARACTER VARYING(250)
);
COMMENT ON TABLE apobi_rapport IS 'Table contenant la description des rapports disponibles sur la plateforme';

/* Table contenant la liste des invites liées à chaque rapport */
CREATE TABLE apobi_rapport_invite (
    id_apobi_rapport_invite SERIAL NOT NULL PRIMARY KEY,
    fk_apobi_rapport INTEGER NOT NULL REFERENCES apobi_rapport(id_apobi_rapport),
    fk_apobi_invite INTEGER NOT NULL REFERENCES apobi_invite(id_apobi_invite)
);
COMMENT ON TABLE apobi_rapport_invite IS 'Table contenant la liste des invites liées à chaque rapport';

/* Table contenant la description des différents serveurs de données des infocentres */
CREATE TABLE apobi_serveur (
    id_apobi_serveur SERIAL NOT NULL PRIMARY KEY,
    se_libelle CHARACTER VARYING(150),
    se_hote CHARACTER VARYING(80),
    se_port CHARACTER VARYING(10)
);
COMMENT ON TABLE apobi_serveur IS 'Table contenant la description des différents serveurs de données des infocentres';

/* Table contenant la description des différents clients de la solution */
CREATE TABLE apobi_client (
    id_apobi_client SERIAL NOT NULL PRIMARY KEY,    
    cl_code CHARACTER VARYING(20),
    cl_nom CHARACTER VARYING(150)
);
COMMENT ON TABLE apobi_client IS 'Table contenant la description des différents clients de la solution';

/* Table contenant la description des différentes bases de données */
CREATE TABLE apobi_database (
    id_apobi_database SERIAL NOT NULL PRIMARY KEY,
    fk_apobi_type_database INTEGER NOT NULL REFERENCES apobi_type_database(id_apobi_type_database),
    fk_apobi_serveur INTEGER NOT NULL REFERENCES apobi_serveur(id_apobi_serveur), -- ON DELETE CASCADE,        
    fk_apobi_client INTEGER NOT NULL REFERENCES apobi_client(id_apobi_client) ON DELETE CASCADE,
    db_name CHARACTER VARYING(150)
);
COMMENT ON TABLE apobi_database IS 'Table contenant la description des différentes bases de données';

/* Table contenant la liste des utilisateurs */
CREATE TABLE apobi_utilisateur (
    id_apobi_utilisateur SERIAL NOT NULL PRIMARY KEY,    
    ut_email CHARACTER VARYING(100) NOT NULL,
    ut_password CHARACTER VARYING(100) NOT NULL,
    ut_admin BOOLEAN DEFAULT FALSE,
    ut_api BOOLEAN DEFAULT FALSE,
    ut_bo_login  CHARACTER VARYING(100),
    ut_bo_password CHARACTER VARYING(100)
);
COMMENT ON TABLE apobi_utilisateur IS 'Table contenant la liste des utilisateurs';

/* Table contenant le lien entre un utilisateur et 1 ou n clients */
CREATE TABLE apobi_client_utilisateur (
    id_apobi_client_utilisateur SERIAL NOT NULL PRIMARY KEY,
    fk_apobi_client INTEGER NOT NULL REFERENCES apobi_client(id_apobi_client),
    fk_apobi_utilisateur INTEGER NOT NULL REFERENCES apobi_utilisateur(id_apobi_utilisateur)
);
COMMENT ON TABLE apobi_client_utilisateur IS 'Table contenant les relations entre les utilisateurs et les clients';

/* Table contenant la pile des commandes en provenance du portail, à traiter par le moteur APOBI */
CREATE TABLE web_commande (    
    cmd_guid CHARACTER VARYING UNIQUE NOT NULL,
    cmd_moment TIMESTAMP WITHOUT TIME ZONE DEFAULT current_timestamp,
    cmd_moment_debut_traitement TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL,
    cmd_traitee BOOLEAN DEFAULT FALSE NOT NULL,
    cmd_traitement_en_cours BOOLEAN DEFAULT FALSE NOT NULL,
    fk_apobi_utilisateur INTEGER NOT NULL REFERENCES apobi_utilisateur(id_apobi_utilisateur) ON DELETE CASCADE
);
COMMENT ON TABLE web_commande IS 'Table contenant la pile des commandes en provenance du portail, à traiter par le moteur APOBI';

/* Table contenant les paramètres d'entrée d'une commande en provenance du portail */
CREATE TABLE web_commande_input (
    id_web_commande_input SERIAL NOT NULL PRIMARY KEY,
    cmd_guid CHARACTER VARYING NOT NULL REFERENCES web_commande(cmd_guid) ON DELETE CASCADE,
    in_param CHARACTER VARYING(50),
    in_valeur TEXT    
);
COMMENT ON TABLE web_commande_input IS 'Table contenant les paramètres d''entrée d''une commande en provenance du portail';

/* Table contenant les paramètres de retour d'une commande en provenance du portail */
CREATE TABLE web_commande_output (    
    id_web_commande_output SERIAL NOT NULL PRIMARY KEY,
    cmd_guid CHARACTER VARYING NOT NULL REFERENCES web_commande(cmd_guid) ON DELETE CASCADE,    
    out_param CHARACTER VARYING(50),
    out_valeur TEXT    
);
COMMENT ON TABLE web_commande_output IS 'Table contenant les paramètres de retour d''une commande en provenance du portail';

/* Table contenant les erreurs déclenchées lors de l''éxecution du moteur APOBIE */
CREATE TABLE web_commande_erreur (
    id_web_commande_erreur SERIAL NOT NULL PRIMARY KEY,
    cmd_guid CHARACTER VARYING NOT NULL REFERENCES web_commande(cmd_guid) ON DELETE CASCADE,    
    err_code CHARACTER VARYING(50),
    err_message TEXT
);
COMMENT ON TABLE web_commande_erreur IS 'Table contenant les erreurs déclenchées lors de l''éxecution du moteur APOBIE';

/* Table contenant les logs d'info issus du portail */
CREATE TABLE web_log_info (
    id_web_log_info SERIAL NOT NULL PRIMARY KEY,
    moment TIMESTAMP WITHOUT TIME ZONE DEFAULT current_timestamp,
    fk_apobi_utilisateur INTEGER,
    log_message TEXT
);

/* Table contenant les logs d'erreur issus du portail */
CREATE TABLE web_log_erreur (
    id_web_log_erreur SERIAL NOT NULL PRIMARY KEY,
    moment TIMESTAMP WITHOUT TIME ZONE DEFAULT current_timestamp,
    fk_apobi_utilisateur INTEGER,
    log_erreur TEXT
);

/* Table contenant les enregistrements des commandes de jetons */
CREATE TABLE apobi_client_jeton (
    id_apobi_client_jeton SERIAL NOT NULL PRIMARY KEY,
    fk_client INTEGER NOT NULL REFERENCES apobi_client(id_apobi_client),
    fk_utilisateur_creation INTEGER NOT NULL REFERENCES apobi_utilisateur(id_apobi_utilisateur),
    cj_date_creation DATE NOT NULL,
    cj_date_debut_validite DATE NOT NULL,
    cj_commentaire CHARACTER VARYING(1000),
    cj_quantite INTEGER NOT NULL
);
COMMENT ON TABLE apobi_client_jeton IS 'Table contenant les enregistrements de commande de jetons';

/* Table contenant les enregistrements d'abonnements des utilisateurs aux rapports */
CREATE TABLE apobi_client_abonnement (
    id_apobi_client_abonnement SERIAL NOT NULL PRIMARY KEY,
    fk_client INTEGER NOT NULL REFERENCES apobi_client(id_apobi_client),
    fk_rapport INTEGER NOT NULL REFERENCES apobi_rapport(id_apobi_rapport),
    fk_planification INTEGER,
    cc_date_activation DATE NOT NULL,
    cc_date_desactivation DATE,
    cc_nb_jetons INTEGER NOT NULL
);
COMMENT ON TABLE apobi_client_abonnement IS 'Table contenant les enregistrements d''abonnements des utilisateurs aux rapports';

/* Table contenant les enregistrements des contenus des rapports commandés */
CREATE TABLE apobi_web_commande_fichier_output (
    id_apobi_web_commande_fichier_output SERIAL NOT NULL PRIMARY KEY,
    cmd_guid CHARACTER VARYING NOT NULL REFERENCES web_commande(cmd_guid) ON DELETE CASCADE,
    fic_extension CHARACTER VARYING(8),
    fic_contenu BYTEA
);
COMMENT ON TABLE apobi_web_commande_fichier_output IS 'Table contenant les fichiers générés par le moteur Windev';


/* ----------------------------------------------------------------------------------------------------*/
/* Fonction permettant de récupérer le GUID de la prochaine commande à traiter, et flagger à en_cours  */
/* ----------------------------------------------------------------------------------------------------*/
CREATE OR REPLACE FUNCTION get_next_guid_commande_a_traiter() RETURNS VARCHAR AS $$

DECLARE 
	GUID VARCHAR;

BEGIN
	
	-- On récupère le GUID de la prochaine commande à traiter
	SELECT * FROM web_commande WHERE cmd_traitee IS FALSE AND cmd_traitement_en_cours IS FALSE LIMIT 1 INTO GUID;
	
	-- On flag l'état de la commande afin d'indiquer que son traitement est en cours
	UPDATE web_commande SET cmd_traitement_en_cours = TRUE, cmd_moment_debut_traitement = date_trunc('second',current_timestamp) WHERE cmd_guid = GUID;
	
	-- On renvoi le GUID de la commande
	RETURN GUID;
	
END;
$$ LANGUAGE 'plpgsql';



/* ---------------------------------------------------------------------------------------------*/
/*                              Insertion des données de test                                   */
/* ---------------------------------------------------------------------------------------------*/

/* Insertion des bases de données */
INSERT INTO apobi_type_database (tdb_code, tdb_libelle, tdb_lswa, tdb_dwh) VALUES 
    ('NR','Non renseigné',FALSE,FALSE),
    ('LSWA','La Solution Web Apolobic',TRUE,FALSE),
    ('DWH','Infocentre',FALSE,TRUE);

/* Insertion des types de données */
INSERT INTO apobi_type_donnee (tdo_code, tdo_libelle) VALUES
    ('CHAINE','Chaine de caractères'),
    ('ENTIER','Entier'),
    ('BOOLEEN','Booléen'),
    ('DATE','Date'),
    ('ANNEE','Année'),
    ('MOIS','Mois');
    
/* Insertion des invites */
INSERT INTO apobi_invite(in_code, in_libelle, fk_apobi_type_donnee, in_requete, fk_apobi_type_database) VALUES 
    ('ANNEE_DEBUT_FACTURATION', 'Année de début de facturation', (SELECT id_apobi_type_donnee FROM apobi_type_donnee WHERE tdo_code = 'ANNEE'), 'SELECT DISTINCT annee FROM dwh.dwh_calendrier',(SELECT id_apobi_type_database FROM apobi_type_database WHERE tdb_code = 'DWH')),
    ('ANNEE_FIN_FACTURATION', 'Année de fin de facturation', (SELECT id_apobi_type_donnee FROM apobi_type_donnee WHERE tdo_code = 'ANNEE'), 'SELECT DISTINCT annee FROM dwh.dwh_calendrier',(SELECT id_apobi_type_database FROM apobi_type_database WHERE tdb_code = 'DWH')),
    ('AFFICHER_FACTURES_CAISSES', 'Afficher les factures caisses', (SELECT id_apobi_type_donnee FROM apobi_type_donnee WHERE tdo_code = 'BOOLEEN'), null,(SELECT id_apobi_type_database FROM apobi_type_database WHERE tdb_code = 'NR'));

/* Insertion des rapports de test */
INSERT INTO apobi_rapport (ra_libelle, ra_code, ra_tarif, fk_apobi_type_database, ra_nom_wdetat) VALUES 
    ('Evolution du chiffre d''affaire','EVOLUTION_CA',2,(SELECT id_apobi_type_database FROM apobi_type_database WHERE tdb_code = 'DWH'),'R00001_BASE_DWH_PORTRAIT_EVO_CA_PAR_ANNEE'),
    ('Etat des Pecs en cours','ETAT_PECS_ENCOURS',3,(SELECT id_apobi_type_database FROM apobi_type_database WHERE tdb_code = 'DWH'),NULL),
    ('Statistiques NOVA','STATS_NOVA',10,(SELECT id_apobi_type_database FROM apobi_type_database WHERE tdb_code = 'DWH'),NULL),
    ('Nombre d''heures par financeur','NB_HEURES_PAR_FINANCEUR',1,(SELECT id_apobi_type_database FROM apobi_type_database WHERE tdb_code = 'DWH'),NULL),
    ('Projection du nombre d''absences salariées sur l''année n+1','PROJECTION_NB_ABSENCES_SALARIES',10,(SELECT id_apobi_type_database FROM apobi_type_database WHERE tdb_code = 'DWH'),NULL);

/* Insertion des serveurs de test */
INSERT INTO apobi_serveur (se_libelle, se_hote, se_port) VALUES 
    ('BO-DATA1','bodata1','5433'),
    ('BO-DATA2','bodata2','5433');

/* Insertion des invites de rapport de test */
INSERT INTO apobi_rapport_invite (fk_apobi_rapport,fk_apobi_invite) VALUES
    ((SELECT id_apobi_rapport FROM apobi_rapport WHERE ra_code = 'STATS_NOVA'), (SELECT id_apobi_invite FROM apobi_invite WHERE in_code = 'ANNEE_DEBUT_FACTURATION')),
    ((SELECT id_apobi_rapport FROM apobi_rapport WHERE ra_code = 'ETAT_PECS_ENCOURS'), (SELECT id_apobi_invite FROM apobi_invite WHERE in_code = 'ANNEE_FIN_FACTURATION')),
    ((SELECT id_apobi_rapport FROM apobi_rapport WHERE ra_code = 'EVOLUTION_CA'), (SELECT id_apobi_invite FROM apobi_invite WHERE in_code = 'ANNEE_DEBUT_FACTURATION')),
    ((SELECT id_apobi_rapport FROM apobi_rapport WHERE ra_code = 'EVOLUTION_CA'), (SELECT id_apobi_invite FROM apobi_invite WHERE in_code = 'ANNEE_FIN_FACTURATION')),
    ((SELECT id_apobi_rapport FROM apobi_rapport WHERE ra_code = 'NB_HEURES_PAR_FINANCEUR'), (SELECT id_apobi_invite FROM apobi_invite WHERE in_code = 'ANNEE_FIN_FACTURATION')),
    ((SELECT id_apobi_rapport FROM apobi_rapport WHERE ra_code = 'PROJECTION_NB_ABSENCES_SALARIES'), (SELECT id_apobi_invite FROM apobi_invite WHERE in_code = 'ANNEE_DEBUT_FACTURATION'));

/* Insertion des clients de test */ 
INSERT INTO apobi_client (cl_code, cl_nom) VALUES
    ('ADM','-'),
    ('CLT1','Apologic 1'),
    ('CLT2','Apologic 2'),
    ('CLT3','Apologic 3'),
    ('CLT4','Apologic 4'),
    ('CLT5','Apologic 5'),
    ('CLT6','Apologic 6');

/* Insertion des bases de données de test */
INSERT INTO apobi_database (fk_apobi_serveur, db_name, fk_apobi_type_database, fk_apobi_client) VALUES
    ((SELECT id_apobi_serveur FROM apobi_serveur WHERE se_libelle = 'BO-DATA1'),'apobi_apoweb_dev',(SELECT id_apobi_type_database FROM apobi_type_database WHERE tdb_code = 'DWH'),(SELECT id_apobi_client FROM apobi_client WHERE cl_code = 'CLT1')),
    ((SELECT id_apobi_serveur FROM apobi_serveur WHERE se_libelle = 'BO-DATA1'),'apobi_apoweb_dev2',(SELECT id_apobi_type_database FROM apobi_type_database WHERE tdb_code = 'DWH'),(SELECT id_apobi_client FROM apobi_client WHERE cl_code = 'CLT2')),
    ((SELECT id_apobi_serveur FROM apobi_serveur WHERE se_libelle = 'BO-DATA1'),'apobi_apoweb_dev3',(SELECT id_apobi_type_database FROM apobi_type_database WHERE tdb_code = 'DWH'),(SELECT id_apobi_client FROM apobi_client WHERE cl_code = 'CLT3')),
    ((SELECT id_apobi_serveur FROM apobi_serveur WHERE se_libelle = 'BO-DATA2'),'apobi_windev_dev',(SELECT id_apobi_type_database FROM apobi_type_database WHERE tdb_code = 'DWH'),(SELECT id_apobi_client FROM apobi_client WHERE cl_code = 'CLT4')),
    ((SELECT id_apobi_serveur FROM apobi_serveur WHERE se_libelle = 'BO-DATA2'),'apobi_windev_dev2',(SELECT id_apobi_type_database FROM apobi_type_database WHERE tdb_code = 'DWH'),(SELECT id_apobi_client FROM apobi_client WHERE cl_code = 'CLT5')),
    ((SELECT id_apobi_serveur FROM apobi_serveur WHERE se_libelle = 'BO-DATA2'),'apobi_windev_dev3',(SELECT id_apobi_type_database FROM apobi_type_database WHERE tdb_code = 'DWH'),(SELECT id_apobi_client FROM apobi_client WHERE cl_code = 'CLT6'));

/* Insertion des utilisateurs de test */
INSERT INTO apobi_utilisateur (ut_email, ut_password, ut_api, ut_admin) VALUES
    ('sebastien.deschamps@apologic.fr','1234',FALSE,FALSE),
    ('yohann.porhel@apologic.fr','1234',FALSE,FALSE),
    ('administrateur','1234',TRUE,TRUE);

/* Insertion des relations entre clients et utilisateurs */
INSERT INTO apobi_client_utilisateur (fk_apobi_client, fk_apobi_utilisateur) VALUES
    ((SELECT id_apobi_client FROM apobi_client ORDER BY random() LIMIT 1),(SELECT id_apobi_utilisateur FROM apobi_utilisateur WHERE ut_email = 'sebastien.deschamps@apologic.fr')),
    ((SELECT id_apobi_client FROM apobi_client ORDER BY random() LIMIT 1),(SELECT id_apobi_utilisateur FROM apobi_utilisateur WHERE ut_email = 'yohann.porhel@apologic.fr'));

/* Insertion des paramétres de test */
INSERT INTO apobi_params (pa_code, pa_valeur) VALUES
    ('APOBIE_REP_GENERATION','D:\Dropbox\Apologic\apobi_www\apobie_out\'),
    ('HTTP_REP_GENERATION','apobie_out');