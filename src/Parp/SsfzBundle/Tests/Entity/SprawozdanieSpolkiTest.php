<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Parp\SsfzBundle\Tests\Entity;

use PHPUnit\Framework\TestCase;
/**
 * Description of SprawozdanieSpolkiTest
 *
 * @author adamw
 */
class SprawozdanieSpolkiTest extends TestCase
{
    
    private $sprawozdanieSpolki;
    
    /**
     * Ustawienie środowiska testowego
     */
    public function setUp() 
    {
        $this->sprawozdanieSpolki = new \Parp\SsfzBundle\Entity\SprawozdanieSpolki();        
    }

    /**
     * Testownaia pola id
     */
    public function testId() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setId($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getId());
    }  
    
    /**
     * Testownaia pola sprawozdanieId
     */
    public function testSprawozdanieId() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setSprawozdanieId($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getSprawozdanieId());
    } 

    /**
     * Testownaia pola liczbaPorzadkowa
     */
    public function testLiczbaPorzadkowa() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setLiczbaPorzadkowa($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getLiczbaPorzadkowa());
    } 
    
    
    /**
     * Testownaia pola nazwaSpolki
     */
    public function testNazwaSpolki() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setNazwaSpolki($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getNazwaSpolki());
    } 


    /**
     * Testownaia pola krs
     */
    public function testKrs() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setKrs($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getKrs());
    } 
    
    /**
     * Testownaia pola uzyskanePrzychody
     */
    public function testUzyskanePrzychody() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setUzyskanePrzychody($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getUzyskanePrzychody());
    } 
    
    /**
     * Testownaia pola planowanePrzychody
     */
    public function testPlanowanePrzychody() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setPlanowanePrzychody($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getPlanowanePrzychody());
    } 
    
    /**
     * Testownaia pola ebitda
     */
    public function testEbitda() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setEbitda($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getEbitda());
    } 

    /**
     * Testownaia pola ncf
     */
    public function testNcf() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setNcf($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getNcf());
    } 

    /**
     * Testownaia pola sumaBilansowa
     */
    public function testSumaBilansowa() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setSumaBilansowa($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getSumaBilansowa());
    } 
    
    
    /**
     * Testownaia pola zatrudnienieEtaty
     */
    public function testZatrudnienieEtaty() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setZatrudnienieEtaty($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getZatrudnienieEtaty());
    } 

    /**
     * Testownaia pola zatrudnioneKobiety
     */
    public function testZatrudnioneKobiety() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setZatrudnioneKobiety($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getZatrudnioneKobiety());
    } 
    
    /**
     * Testownaia pola zatrudnieniMezczyzni
     */
    public function testZatrudnieniMezczyzni() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setZatrudnieniMezczyzni($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getZatrudnieniMezczyzni());
    }
    
    /**
     * Testownaia pola zatrudnienieInneFormy
     */
    public function testZatrudnienieInneFormy() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setZatrudnienieInneFormy($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getZatrudnienieInneFormy());
    }

    /**
     * Testownaia pola zatrudnienieInneFormyKobiety
     */
    public function testZatrudnienieInneFormyKobiety() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setZatrudnienieInneFormyKobiety($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getZatrudnienieInneFormyKobiety());
    }

    /**
     * Testownaia pola zatrudnienieInneFormyMezczyzni
     */
    public function testZatrudnienieInneFormyMezczyzni() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setZatrudnienieInneFormyMezczyzni($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getZatrudnienieInneFormyMezczyzni());
    }
    
    /**
     * Testownaia pola zatrudnieniewStosunkuDoPoprzedniegoRoku
     */
    public function testZatrudnieniewStosunkuDoPoprzedniegoRoku() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setZatrudnieniewStosunkuDoPoprzedniegoRoku($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getZatrudnieniewStosunkuDoPoprzedniegoRoku());
    }
    
    /**
     * Testownaia pola zatrudnieniewStosunkuDoPoprzedniegoOkresu
     */
    public function testZatrudnieniewStosunkuDoPoprzedniegoOkresu() 
    {
        $var = 5;
        $this->sprawozdanieSpolki->setZatrudnieniewStosunkuDoPoprzedniegoOkresu($var);
        $this->assertEquals($var, $this->sprawozdanieSpolki->getZatrudnieniewStosunkuDoPoprzedniegoOkresu());
    }
    
    /**
     * Testownaia pola sprawozdanie
     */
    public function testSprawozdanie() 
    {
        $sprawozdanie =  new \Parp\SsfzBundle\Entity\Sprawozdanie();
        $sprawozdanie->setId(10);
        $sprawozdanie->setCreatorId(11);
        $this->sprawozdanieSpolki->setSprawozdanie($sprawozdanie);
        $this->assertEquals($sprawozdanie->getId(), $this->sprawozdanieSpolki->getSprawozdanie()->getId());
        $this->assertEquals($sprawozdanie->getCreatorId(), $this->sprawozdanieSpolki->getSprawozdanie()->getCreatorId());
    }
    
    /**
     * Czyszczenie środowiska testowego
     */
    public function tearDown() 
    {
        $this->sprawozdanieSpolki = null;
    }
}
