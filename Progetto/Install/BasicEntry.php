<?php

class BasicEntry{

    /**
     *  Method to populate the database with basic entries.
     * @return void
     */
    public static function populateDb(): void {

    // User
    $u1 = new EUser(ADMIN, 'admin', 'admin123', 'Admin', 'Admin', '2003-04-18', 'Italy', 'Pescara', 'PE', '65125', 'Via Monte Saraceno', '11', 'admin@admin.com', '0000000000');
    $u2 = new EUser(BASIC, 'mario.rossi', 'passMario1', 'Mario', 'Rossi', '1995-06-12', 'Italy', 'Roma', 'RM', '00100', 'Via Appia Nuova', '45', 'mario.rossi@example.com', '3201234567');
    $u3 = new EUser(READER, 'lisa.romano', 'lisaRead@24', 'Lisa', 'Romano', '1991-08-14', 'Italy', 'Trieste', 'TS', '34100', 'Via San Nicolò', '9', 'lisa.romano@example.com', '3275566888');
    $u4 = new EUser(WRITER, 'matteo.riva', 'writerMatteo$', 'Matteo', 'Riva', '1989-02-11', 'Italy', 'Parma', 'PR', '43100', 'Viale Piacenza', '23', 'matteo.riva@example.com', '3289988776');
    $u5 = new EUser(BASIC, 'francesca.neri', 'fraNeri2024', 'Francesca', 'Neri', '2000-05-05', 'Italy', 'Bologna', 'BO', '40100', 'Via dell\'Indipendenza', '34', 'francesca.neri@example.com', '3295566778');
    $u6 = new EUser(ADMIN, 'ezio.auditore', 'BestAssassin1', 'Ezio', 'Auditore', '1459-06-24', 'Italy', 'Firenze', 'FI', '50100', 'Viale dei Mille', '8', 'ezio.auditore@example.com', '3214455667',"Bella vita la nostra, eh Fratello? La migliore, possa non cambiare mai e possa non cambiare noi.");
    $u7 = new EUser(WRITER, 'chiara.fontana', 'chiaraW_2024', 'Chiara', 'Fontana', '1994-04-04', 'Italy', 'Ancona', 'AN', '60100', 'Via XXV Aprile', '5', 'chiara.fontana@example.com', '3229988775');
    $u8 = new EUser(BASIC, 'carlo.bruni', 'adminCarlo!', 'Carlo', 'Bruni', '1985-07-17', 'Italy', 'Genova', 'GE', '16100', 'Via XX Settembre', '55', 'carlo.bruni@example.com', '3242233445');
    $u9 = new EUser(BASIC, 'sara.galli', 'saraBasic99', 'Sara', 'Galli', '1996-11-03', 'Italy', 'Verona', 'VR', '37100', 'Piazza Bra', '3', 'sara.galli@example.com', '3267788990');
    $u10 = new EUser(READER, 'giorgio.conti', 'giorgioRead99', 'Giorgio', 'Conti', '1993-12-21', 'Italy', 'Lecce', 'LE', '73100', 'Via Leuca', '17', 'giorgio.conti@example.com', '3254433221');
    
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

    $p6 = new EPlotCard(1459, $u6);
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
    
    $sub1 = new ESubscription(WRITER, '1 year', 200.00);
    $sub2 = new ESubscription(WRITER, '1 month', 20.00);
    $sub3 = new ESubscription(WRITER, '1 week', 10.00);
    $sub4 = new ESubscription(READER, '1 year', 100.00);
    $sub5 = new ESubscription(READER, '1 month', 10.00);
    $sub6 = new ESubscription(READER, '1 week', 5.00);

    //ECreditCard

    $cc1 = new ECreditCard('1111 2222 3333 4444', 'Marco', 'Gentile', '2025-12-31', 123);
    $cc2 = new ECreditCard('5555 6666 7777 8888', 'Chiara', 'Marino', '2024-11-30', 123);
    $cc3 = new ECreditCard('9999 0000 1111 2222', 'Stefano', 'De Luca', '2023-10-31', 123);
    $cc4 = new ECreditCard('3333 4444 5555 6666', 'Francesco', 'Romano', '2026-09-30', 122);



    //EPurchase
    
    $pur1 = new EPurchase('2025-10-01','2026-10-01','Italy','Roma','RM','00100','Via Appia Nuova, 45', '1', $u7,$sub1,$cc1);
    $pur2 = new EPurchase('2026-01-15', '2026-02-15', 'Italy', 'Torino', 'TO', '10100', 'Via Po, 19', '2', $u4, $sub2, $cc2);
    $pur3 = new EPurchase('2026-06-20', '2026-06-27', 'Italy', 'Genova', 'GE', '16100', 'Via XX Settembre, 55', '3', $u10, $sub6, $cc3);
    $pur4 = new EPurchase('2024-11-05', '2025-11-05', 'Italy', 'Verona', 'VR', '37100', 'Piazza Bra, 3', '4', $u3, $sub4, $cc4);

    //EFollow
    $fo1 = new EFollow($u3,$u4);
    $fo2 = new EFollow($u10,$u7);
    
    //EArticle
    $art1 = new EArticle('La Divina Commedia', 'Dante si è perso :(', 'Nel bel mezzo del cazzo' , 'approved', 'Romazo', 'Classico', '1400-01-01', $u4);
    $u4->addArticle($art1);
    $art2 = new EArticle('Il Gattopardo', 'Declino di una famiglia siciliana', 'Una storia di trasformazioni e immobilismo', 'approved', 'Romanzo', 'Storico', '1958-05-01', $u4);
    $u4->addArticle($art2);
    $art3 = new EArticle('1984', 'Il Grande Fratello ti osserva', 'Distopia totalitaria tra controllo e censura', 'approved', 'Romanzo', 'Fantascienza', '1949-06-08', $u4);
    $u4->addArticle($art3);
    $art4 = new EArticle('Orgoglio e Pregiudizio', 'Elizabeth Bennet è troppo sveglia per il suo tempo', 'Una danza tra amore e convenzioni sociali', 'approved', 'Romanzo', 'Sentimentale', '1813-01-28', $u4);
    $u4->addArticle($art4);
    $art5 = new EArticle('Il Nome della Rosa', 'Omicidi misteriosi in un’abbazia medievale', 'Un’indagine tra libri, simboli e inquisitori', 'approved', 'Romanzo', 'Giallo', '1980-10-01', $u7);
    $u7->addArticle($art5);
    $art6 = new EArticle('Siddhartha', 'La ricerca spirituale di un giovane indiano', 'Un cammino tra ascetismo, ricchezza e consapevolezza', 'approved', 'Romanzo', 'Spirituale', '1922-01-01', $u7);
    $u7->addArticle($art6);
    $art7 = new EArticle('Frankenstein', 'La tragedia dell’ambizione scientifica', 'Un mostro umano più degli umani stessi', 'approved', 'Romanzo', 'Horror', '1818-03-11', $u7);
    $u7->addArticle($art7);
    $art8 = new EArticle('Il barone rampante', 'Un ragazzo sale su un albero… e ci resta', 'Vivere tra i rami per vedere il mondo meglio', 'approved', 'Romanzo', 'Fiabesco', '1957-11-25', $u7);
    $u7->addArticle($art8);
    

    //EReview

    $rev1 = new EReview(5,'PRIMO', '2012-12-12', $u7, $art1);
    $art1->addReview($rev1);
    $u7->addReview($rev1);

    $rev2 = new EReview(4, 'Bellissimo romanzo storico', '2020-01-15', $u7, $art2);
    $art2->addReview($rev2);
    $u7->addReview($rev2);

    $rev23 = new EReview(3, 'Interessante ma complesso', '2023-01-10', $u3, $art1);
    $art1->addReview($rev23);
    $u3->addReview($rev23);

    $rev24 = new EReview(5, 'Capolavoro assoluto', '2023-01-15', $u4, $art2);
    $art2->addReview($rev24);
    $u4->addReview($rev24);

    $rev25 = new EReview(4, 'Molto coinvolgente', '2023-02-01', $u7, $art3);
    $art3->addReview($rev25);
    $u7->addReview($rev25);

    $rev26 = new EReview(2, 'Troppo lento', '2023-02-10', $u10, $art4);
    $art4->addReview($rev26);
    $u10->addReview($rev26);

    $rev27 = new EReview(5, 'Mi ha emozionato', '2023-03-05', $u3, $art5);
    $art5->addReview($rev27);
    $u3->addReview($rev27);

    $rev28 = new EReview(4, 'Ottima lettura', '2023-03-12', $u4, $art6);
    $art6->addReview($rev28);
    $u4->addReview($rev28);

    $rev29 = new EReview(3, 'Niente di speciale', '2023-03-20', $u7, $art7);
    $art7->addReview($rev29);
    $u7->addReview($rev29);

    $rev30 = new EReview(1, 'Noioso', '2023-04-01', $u10, $art8);
    $art8->addReview($rev30);
    $u10->addReview($rev30);

    $rev31 = new EReview(5, 'Storia bellissima', '2023-04-15', $u3, $art2);
    $art2->addReview($rev31);
    $u3->addReview($rev31);

    $rev32 = new EReview(3, 'Scritto bene ma poco originale', '2023-05-01', $u4, $art3);
    $art3->addReview($rev32);
    $u4->addReview($rev32);

    $rev33 = new EReview(4, 'Letto tutto d\'un fiato', '2023-05-10', $u7, $art4);
    $art4->addReview($rev33);
    $u7->addReview($rev33);

    $rev34 = new EReview(2, 'Mi aspettavo di più', '2023-05-20', $u10, $art5);
    $art5->addReview($rev34);
    $u10->addReview($rev34);

    $rev35 = new EReview(5, 'Assolutamente consigliato', '2023-06-01', $u3, $art6);
    $art6->addReview($rev35);
    $u3->addReview($rev35);

    $rev36 = new EReview(4, 'Un grande classico', '2023-06-15', $u4, $art7);
    $art7->addReview($rev36);
    $u4->addReview($rev36);

    $rev37 = new EReview(3, 'Carino, ma non il mio genere', '2023-07-01', $u7, $art8);
    $art8->addReview($rev37);
    $u7->addReview($rev37);

    $rev38 = new EReview(1, 'Lento e difficile da seguire', '2023-07-10', $u10, $art1);
    $art1->addReview($rev38);
    $u10->addReview($rev38);

    $rev39 = new EReview(4, 'Trama avvincente', '2023-08-01', $u3, $art3);
    $art3->addReview($rev39);
    $u3->addReview($rev39);

    $rev40 = new EReview(5, 'Meraviglioso', '2023-08-15', $u4, $art5);
    $art5->addReview($rev40);
    $u4->addReview($rev40);

        
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

    // utenti
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
    // plot cards
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
    // subscriptions
    FPersistentManager::getInstance()->saveInDb($sub1);
    FPersistentManager::getInstance()->saveInDb($sub2);
    FPersistentManager::getInstance()->saveInDb($sub3);
    FPersistentManager::getInstance()->saveInDb($sub4);
    //credit cards
    FPersistentManager::getInstance()->saveInDb($cc1);
    FPersistentManager::getInstance()->saveInDb($cc2);
    FPersistentManager::getInstance()->saveInDb($cc3);
    FPersistentManager::getInstance()->saveInDb($cc4);
    // purchases
    FPersistentManager::getInstance()->saveInDb($pur1);
    FPersistentManager::getInstance()->saveInDb($pur2);
    FPersistentManager::getInstance()->saveInDb($pur3);
    FPersistentManager::getInstance()->saveInDb($pur4);
    // follows
    FPersistentManager::getInstance()->saveInDb($fo1);
    FPersistentManager::getInstance()->saveInDb($fo2);
    // articles
    FPersistentManager::getInstance()->saveInDb($art1);
    FPersistentManager::getInstance()->saveInDb($art2);
    FPersistentManager::getInstance()->saveInDb($art3);
    FPersistentManager::getInstance()->saveInDb($art4);
    FPersistentManager::getInstance()->saveInDb($art5);
    FPersistentManager::getInstance()->saveInDb($art6);
    FPersistentManager::getInstance()->saveInDb($art7);
    FPersistentManager::getInstance()->saveInDb($art8);
    // reviews
    FPersistentManager::getInstance()->saveInDb($rev1);
    FPersistentManager::getInstance()->saveInDb($rev2);
    FPersistentManager::getInstance()->saveInDb($rev23);
    FPersistentManager::getInstance()->saveInDb($rev24);
    FPersistentManager::getInstance()->saveInDb($rev25);
    FPersistentManager::getInstance()->saveInDb($rev26);
    FPersistentManager::getInstance()->saveInDb($rev27);
    FPersistentManager::getInstance()->saveInDb($rev28);
    FPersistentManager::getInstance()->saveInDb($rev29);
    FPersistentManager::getInstance()->saveInDb($rev30);
    FPersistentManager::getInstance()->saveInDb($rev31);
    FPersistentManager::getInstance()->saveInDb($rev32);
    FPersistentManager::getInstance()->saveInDb($rev33);
    FPersistentManager::getInstance()->saveInDb($rev34);
    FPersistentManager::getInstance()->saveInDb($rev35);
    FPersistentManager::getInstance()->saveInDb($rev36);
    FPersistentManager::getInstance()->saveInDb($rev37);
    FPersistentManager::getInstance()->saveInDb($rev38);
    FPersistentManager::getInstance()->saveInDb($rev39);
    FPersistentManager::getInstance()->saveInDb($rev40);
    // readings
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