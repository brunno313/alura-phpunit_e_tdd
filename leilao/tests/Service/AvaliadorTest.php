<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase {

  /**
   * Set up.
   */
  public function setUp(): void {
    $this->leilao = new Leilao('Fiat 147 0KM');
    $this->leiloeiro = new Avaliador();

    $this->maria = new Usuario('Maria');
    $this->joao = new Usuario('João');
  }

  /**
   * Test avalia() maior valor with order crescent.
   */
  public function testAvaliaMaiorValorWithOrderCrescent() {
    $this->leilao->recebeLance(new Lance($this->joao, 2000));
    $this->leilao->recebeLance(new Lance($this->maria, 2500));

    $this->leiloeiro->avalia($this->leilao);

    $maiorValor = $this->leiloeiro->getMaiorValor();

    // Assert - Then
    $this->assertEquals(2500, $maiorValor);
  }

  /**
   * Test avalia() maior valor with order decrescent.
   */
  public function testAvaliaMaiorValorWithOrderDecrescent() {
    $this->leilao->recebeLance(new Lance($this->maria, 2500));
    $this->leilao->recebeLance(new Lance($this->joao, 2000));

    $this->leiloeiro->avalia($this->leilao);

    $maiorValor = $this->leiloeiro->getMaiorValor();

    // Assert - Then
    $this->assertEquals(2500, $maiorValor);
  }

  /**
   * Test avalia() menor valor with order crescent.
   */
  public function testAvaliaMenorValorWithOrderCrescent() {
    $this->leilao->recebeLance(new Lance($this->joao, 2000));
    $this->leilao->recebeLance(new Lance($this->maria, 2500));

    $this->leiloeiro->avalia($this->leilao);

    $menorValor = $this->leiloeiro->getMenorValor();

    // Assert - Then
    $this->assertEquals(2000, $menorValor);
  }

  /**
   * Test avalia() menor valor with order decrescent.
   */
  public function testAvaliaMenorValorWithOrderDecrescent() {
    $this->leilao->recebeLance(new Lance($this->maria, 2500));
    $this->leilao->recebeLance(new Lance($this->joao, 2000));

    $this->leiloeiro->avalia($this->leilao);

    $menorValor = $this->leiloeiro->getMenorValor();

    // Assert - Then
    $this->assertEquals(2000, $menorValor);
  }

}
