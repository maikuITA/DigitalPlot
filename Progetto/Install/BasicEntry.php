<?php

class BasicEntry{

    /**
     *  Method to populate the database with basic entries.
     * @return void
     */
    public static function populateDb(): void {

    // User
    $u1 = new EUser(ADMIN,'admin','admin123','Admin','Admin','2003-04-18', 'Via Monte Saraceno, 11','Pescara','admin@admin.com','0000000000');
    $u2 = new EUser(BASIC,'Mario', 'Mpass01', 'Mario', 'Rossi', '1998-09-12', 'Via Lago di Garda, 24' ,'Roma', 'mario.rossi@example.com', '3281234567');
    $u3 = new EUser(BASIC,'Lucia', 'LuciaPwd!', 'Lucia', 'Bianchi', '1995-07-23', 'Via Colli Euganei, 15' ,'Milano', 'lucia.bianchi@example.com', '3297654321',);
    $u4 = new EUser(BASIC,'Giulia', 'GiuLia22', 'Giulia', 'Verdi', '2001-05-30','Via Bosco Ceduo, 33' ,'Torino', 'giulia.verdi@example.com', '3271239876');
    $u5 = new EUser(BASIC,'Lorenzo', 'Lz@1999', 'Lorenzo', 'Conti', '1999-02-14','Via Valle d\'Aosta, 9', 'Firenze', 'lorenzo.conti@example.com', '3209988776');
    $u6 = new EUser(BASIC,'Elena', 'Elena77_', 'Elena', 'Ferrari', '2000-12-04','Via Fiume Adda, 21' ,'Bologna', 'elena.ferrari@example.com', '3218877665');
    $u7 = new EUser(READER,'Marco', 'M@rco123', 'Marco', 'Gentile', '1997-03-03','Via Pianura Padana, 12','Napoli','marco.gentile@example.com', '3301122334');
    $u8 = new EUser(READER,'Chiara', 'Chiara!98', 'Chiara', 'Marino','1998-12-15','Via Pianura Padana, 12' ,'Genova', 'chiara.marino@example.com','3312233445');
    $u9 = new EUser(WRITER,'Stefano', 'Stef_99x', 'Stefano', 'De Luca', '1996-03-05','Via Monte Subasio, 4', 'Palermo', 'stefano.deluca@example.com' ,'3323344556');
    $u10 = new EUser(WRITER,'Francesca', 'Fr@nce12', 'Francesca', 'Romano', '2002-02-30','Via Costa Smeralda, 18', 'Trieste', 'francesca.romano@example.com' ,'3334455667');

    //PlotCard
    $p1 = new EPlotCard(10000, $u1);
    $u1->addPlotCard($p1);

    $p2 = new EPlotCard(8500, $u2);
    $u2->addPlotCard($p2);

    $p3 = new EPlotCard(9200, $u3);
    $u3->addPlotCard($p3);

    $p4 = new EPlotCard(7600, $u4);
    $u4->addPlotCard($p4);

    $p5 = new EPlotCard(11000, $u5);
    $u5->addPlotCard($p5);

    $p6 = new EPlotCard(9700, $u6);
    $u6->addPlotCard($p6);

    $p7 = new EPlotCard(12500, $u7);
    $u7->addPlotCard($p7);

    $p8 = new EPlotCard(8900, $u8);
    $u8->addPlotCard($p8);

    $p9 = new EPlotCard(10100, $u9);
    $u9->addPlotCard($p9);

    $p10 = new EPlotCard(8800, $u10);
    $u10->addPlotCard($p10);

    //ESubcription

    $sub1 = new ESubscription('writer', '1 month', 20.00);
    $sub2 = new ESubscription('writer', '1 week', 10.00);
    $sub3 = new ESubscription('reader', '1 month', 10.00);
    $sub4 = new ESubscription('reader', '1 week', 5.00);

    //ECreditCard

    $cc1 = new ECreditCard('1111 2222 3333 4444', 'Marco', 'Gentile', '2025-12-31', 123);
    $cc2 = new ECreditCard('5555 6666 7777 8888', 'Chiara', 'Marino', '2024-11-30', 123);
    $cc3 = new ECreditCard('9999 0000 1111 2222', 'Stefano', 'De Luca', '2023-10-31', 123);
    $cc4 = new ECreditCard('3333 4444 5555 6666', 'Francesco', 'Romano', '2026-09-30', 122);

    //EDiscount

    $d1 = new EDiscount('ZZZZ',200);

    //EPurchase
    
    $pur1 = new EPurchase('2023-10-01','2023-11-01',$u7,'Via Pianura Padana, 12',$sub3,$d1,$cc1);
    $pur2 = new EPurchase('2023-10-01','2024-10-01',$u8,'Via Pianura Padana, 12',$sub4,null,$cc2);
    $pur3 = new EPurchase('2023-10-01','2027-10-01',$u9,'Via Monte Subasio, 4',$sub1,null,$cc3);
    $pur4 = new EPurchase('2023-10-01','2023-12-01',$u10,'Via Costa Smeralda, 18',$sub2,null,$cc4);

    $d1->addPurchase($pur1);

    //EFollow
    $fo1 = new EFollow($u7,$u9);
    $fo2 = new EFollow($u8,$u9);
    
    //EArticle
    $art1 = new EArticle('La Divina Commedia', 'Dante si è perso :(', 'Nel bel mezzo del cazzo' , 'approved', 'Romazo', 'Classico', '1400-01-01', $u9);
    $u9->addArticle($art1);
    $art2 = new EArticle('Il Gattopardo', 'Declino di una famiglia siciliana', 'Una storia di trasformazioni e immobilismo', 'approved', 'Romanzo', 'Storico', '1958-05-01', $u9);
    $u9->addArticle($art2);
    $art3 = new EArticle('1984', 'Il Grande Fratello ti osserva', 'Distopia totalitaria tra controllo e censura', 'approved', 'Romanzo', 'Fantascienza', '1949-06-08', $u9);
    $u9->addArticle($art3);
    $art4 = new EArticle('Orgoglio e Pregiudizio', 'Elizabeth Bennet è troppo sveglia per il suo tempo', 'Una danza tra amore e convenzioni sociali', 'approved', 'Romanzo', 'Sentimentale', '1813-01-28', $u9);
    $u9->addArticle($art4);
    $art5 = new EArticle('Il Nome della Rosa', 'Omicidi misteriosi in un’abbazia medievale', 'Un’indagine tra libri, simboli e inquisitori', 'approved', 'Romanzo', 'Giallo', '1980-10-01', $u9);
    $u9->addArticle($art5);
    $art6 = new EArticle('Siddhartha', 'La ricerca spirituale di un giovane indiano', 'Un cammino tra ascetismo, ricchezza e consapevolezza', 'approved', 'Romanzo', 'Spirituale', '1922-01-01', $u10);
    $u10->addArticle($art6);
    $art7 = new EArticle('Frankenstein', 'La tragedia dell’ambizione scientifica', 'Un mostro umano più degli umani stessi', 'approved', 'Romanzo', 'Horror', '1818-03-11', $u10);
    $u10->addArticle($art7);
    $art8 = new EArticle('Il barone rampante', 'Un ragazzo sale su un albero… e ci resta', 'Vivere tra i rami per vedere il mondo meglio', 'approved', 'Romanzo', 'Fiabesco', '1957-11-25', $u10);
    $u10->addArticle($art8);

    //EReview

    $rev1 = new EReview(5,'PRIMO', '2012-12-12', $u7, $art1);
    $art1->addReview($rev1);
    $u7->addReview($rev1);

    $rev2 = new EReview(4, 'Bellissimo romanzo storico', '2020-01-15', $u7, $art2);
    $art2->addReview($rev2);
    $u7->addReview($rev2);

    $rev3 = new EReview(5, 'Distopico e attuale', '2021-03-10', $u8, $art3);
    $art3->addReview($rev3);
    $u8->addReview($rev3);

    $rev4 = new EReview(3, 'Carino ma lento', '2019-07-22', $u9, $art4);
    $art4->addReview($rev4);
    $u9->addReview($rev4);

    $rev5 = new EReview(5, 'Geniale! Eco non delude.', '2022-02-17', $u10, $art5);
    $art5->addReview($rev5);
    $u10->addReview($rev5);

    $rev6 = new EReview(2, 'Troppo filosofico per i miei gusti', '2021-09-30', $u7, $art6);
    $art6->addReview($rev6);
    $u7->addReview($rev6);

    $rev7 = new EReview(4, 'Interessante rilettura del mito', '2023-04-01', $u8, $art7);
    $art7->addReview($rev7);
    $u8->addReview($rev7);

    $rev8 = new EReview(1, 'Non l\'ho proprio capito...', '2018-11-11', $u9, $art8);
    $art8->addReview($rev8);
    $u9->addReview($rev8);

    $rev9 = new EReview(5, 'Poesia pura', '2020-06-06', $u10, $art1);
    $art1->addReview($rev9);
    $u10->addReview($rev9);

    $rev10 = new EReview(4, 'Un romanzo da leggere almeno una volta', '2019-12-05', $u7, $art2);
    $art2->addReview($rev10);
    $u7->addReview($rev10);

    $rev11 = new EReview(3, 'Troppa lentezza nella trama', '2020-08-20', $u8, $art3);
    $art3->addReview($rev11);
    $u8->addReview($rev11);

    $rev12 = new EReview(5, 'Elizabeth è un personaggio fantastico', '2021-01-02', $u9, $art4);
    $art4->addReview($rev12);
    $u9->addReview($rev12);

    $rev13 = new EReview(2, 'Non sono riuscito a finirlo', '2022-10-10', $u10, $art5);
    $art5->addReview($rev13);
    $u10->addReview($rev13);

    $rev14 = new EReview(4, 'Molto spirituale e riflessivo', '2023-03-15', $u7, $art6);
    $art6->addReview($rev14);
    $u7->addReview($rev14);

    $rev15 = new EReview(5, 'Attualissimo anche oggi', '2024-05-09', $u8, $art3);
    $art3->addReview($rev15);
    $u8->addReview($rev15);

    $rev16 = new EReview(1, 'Noioso e sopravvalutato', '2017-07-14', $u9, $art7);
    $art7->addReview($rev16);
    $u9->addReview($rev16);

    $rev17 = new EReview(3, 'Bella idea, ma poco coinvolgente', '2021-11-25', $u10, $art8);
    $art8->addReview($rev17);
    $u10->addReview($rev17);

    $rev18 = new EReview(5, 'Capolavoro assoluto', '2022-04-04', $u7, $art1);
    $art1->addReview($rev18);
    $u7->addReview($rev18);

    $rev19 = new EReview(2, 'Non fa per me', '2020-02-29', $u8, $art6);
    $art6->addReview($rev19);
    $u8->addReview($rev19);

    $rev20 = new EReview(4, 'Mi ha sorpreso positivamente', '2023-09-12', $u9, $art2);
    $art2->addReview($rev20);
    $u9->addReview($rev20);

    $rev21 = new EReview(5, 'Incredibilmente attuale', '2024-01-30', $u10, $art3);
    $art3->addReview($rev21);
    $u10->addReview($rev21);

    $rev22 = new EReview(3, 'Stile interessante', '2022-06-18', $u7, $art5);
    $art5->addReview($rev22);
    $u7->addReview($rev22);
        
    //EReading
    
    $read1 = new EReading($u1, $art1);
    $u1->addReading($read1);
    $art1->addReading($read1);

    $read2 = new EReading($u2, $art3);
    $u2->addReading($read2);
    $art3->addReading($read2);

    $read3 = new EReading($u3, $art2);
    $u3->addReading($read3);
    $art2->addReading($read3);

    $read4 = new EReading($u4, $art4);
    $u4->addReading($read4);
    $art4->addReading($read4);

    $read5 = new EReading($u5, $art5);
    $u5->addReading($read5);
    $art5->addReading($read5);

    $read6 = new EReading($u6, $art6);
    $u6->addReading($read6);
    $art6->addReading($read6);

    $read7 = new EReading($u7, $art1);
    $u7->addReading($read7);
    $art1->addReading($read7);

    $read8 = new EReading($u8, $art7);
    $u8->addReading($read8);
    $art7->addReading($read8);

    $read9 = new EReading($u9, $art8);
    $u9->addReading($read9);
    $art8->addReading($read9);

    $read10 = new EReading($u10, $art2);
    $u10->addReading($read10);
    $art2->addReading($read10);

    $read11 = new EReading($u3, $art6);
    $u3->addReading($read11);
    $art6->addReading($read11);

    //Popolazione db

    FPersistentManager::getInstance()->saveInDb($u1);
    FPersistentManager::getInstance()->saveInDb($u2);
    FPersistentManager::getInstance()->saveInDb($u3);
    FPersistentManager::getInstance()->saveInDb($u4);
    FPersistentManager::getInstance()->saveInDb($u5);
    FPersistentManager::getInstance()->saveInDb($u6);
    FPersistentManager::getInstance()->saveInDb($u7);
    FPersistentManager::getInstance()->saveInDb($u8);
    FPersistentManager::getInstance()->saveInDb($u9);
    FPersistentManager::getInstance()->saveInDb($u10);

    FPersistentManager::getInstance()->saveInDb($p1);
    FPersistentManager::getInstance()->saveInDb($p2);
    FPersistentManager::getInstance()->saveInDb($p3);
    FPersistentManager::getInstance()->saveInDb($p4);
    FPersistentManager::getInstance()->saveInDb($p5);
    FPersistentManager::getInstance()->saveInDb($p6);
    FPersistentManager::getInstance()->saveInDb($p7);
    FPersistentManager::getInstance()->saveInDb($p8);
    FPersistentManager::getInstance()->saveInDb($p9);
    FPersistentManager::getInstance()->saveInDb($p10);

    FPersistentManager::getInstance()->saveInDb($sub1);
    FPersistentManager::getInstance()->saveInDb($sub2);
    FPersistentManager::getInstance()->saveInDb($sub3);
    FPersistentManager::getInstance()->saveInDb($sub4);

    FPersistentManager::getInstance()->saveInDb($cc1);
    FPersistentManager::getInstance()->saveInDb($cc2);
    FPersistentManager::getInstance()->saveInDb($cc3);
    FPersistentManager::getInstance()->saveInDb($cc4);

    FPersistentManager::getInstance()->saveInDb($d1);

    FPersistentManager::getInstance()->saveInDb($pur1);
    FPersistentManager::getInstance()->saveInDb($pur2);
    FPersistentManager::getInstance()->saveInDb($pur3);
    FPersistentManager::getInstance()->saveInDb($pur4);

    FPersistentManager::getInstance()->saveInDb($fo1);
    FPersistentManager::getInstance()->saveInDb($fo2);

    FPersistentManager::getInstance()->saveInDb($art1);
    FPersistentManager::getInstance()->saveInDb($art2);
    FPersistentManager::getInstance()->saveInDb($art3);
    FPersistentManager::getInstance()->saveInDb($art4);
    FPersistentManager::getInstance()->saveInDb($art5);
    FPersistentManager::getInstance()->saveInDb($art6);
    FPersistentManager::getInstance()->saveInDb($art7);
    FPersistentManager::getInstance()->saveInDb($art8);

    FPersistentManager::getInstance()->saveInDb($rev1);
    FPersistentManager::getInstance()->saveInDb($rev2);
    FPersistentManager::getInstance()->saveInDb($rev3);
    FPersistentManager::getInstance()->saveInDb($rev4);
    FPersistentManager::getInstance()->saveInDb($rev5);
    FPersistentManager::getInstance()->saveInDb($rev6);
    FPersistentManager::getInstance()->saveInDb($rev7);
    FPersistentManager::getInstance()->saveInDb($rev8);
    FPersistentManager::getInstance()->saveInDb($rev9);
    FPersistentManager::getInstance()->saveInDb($rev10);
    FPersistentManager::getInstance()->saveInDb($rev11);
    FPersistentManager::getInstance()->saveInDb($rev12);
    FPersistentManager::getInstance()->saveInDb($rev13);
    FPersistentManager::getInstance()->saveInDb($rev14);
    FPersistentManager::getInstance()->saveInDb($rev15);
    FPersistentManager::getInstance()->saveInDb($rev16);
    FPersistentManager::getInstance()->saveInDb($rev17);
    FPersistentManager::getInstance()->saveInDb($rev18);
    FPersistentManager::getInstance()->saveInDb($rev19);
    FPersistentManager::getInstance()->saveInDb($rev20);
    FPersistentManager::getInstance()->saveInDb($rev21);
    FPersistentManager::getInstance()->saveInDb($rev22);

    FPersistentManager::getInstance()->saveInDb($read1);
    FPersistentManager::getInstance()->saveInDb($read2);
    FPersistentManager::getInstance()->saveInDb($read3);
    FPersistentManager::getInstance()->saveInDb($read4);
    FPersistentManager::getInstance()->saveInDb($read5);
    FPersistentManager::getInstance()->saveInDb($read6);
    FPersistentManager::getInstance()->saveInDb($read7);
    FPersistentManager::getInstance()->saveInDb($read8);
    FPersistentManager::getInstance()->saveInDb($read9);
    FPersistentManager::getInstance()->saveInDb($read10);
    FPersistentManager::getInstance()->saveInDb($read11);

    }

    /**
     * Method to drop all tables in the database.
     * @return bool True if tables were dropped successfully, false otherwise.
     */
    public static function dropDates(): void {
        FPersistentManager::getInstance()->clearAll();
    }
}