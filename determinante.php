<?php
/**
 * Calcular determinante de Matriz NxN
 * Utilizando método Gauss-Jordan (escalonamento / triangularização)
 * @author  Glauber Portella <glauberportella@gmail.com>
 */
class DeterminanteNxN {

	/**
	 * Calcula determinante de matriz quadrada
	 * @param  array $matriz Matriz quadrada
	 * @return float
	 */
	public static function calcular(&$matriz)
	{
		$det 	= 1; // resultado
		$n 		= count($matriz); // dimensao da matriz
		$sinal 	= 1; // controlar sinal do determinante
		$m 		= 1; // controlar operacao de multiplicacao de linha por constante

		for ($i = 0; $i < $n; $i++) {
			if ($matriz[$i][$i] === 0) {
				for ($j = $i + 1; $j < $n; $j++) {
					if ($matriz[$j][$i] !== 0) {
						for ($k = 0; $k < $n; $k++) {
							$temp = $matriz[$i][$k];
							$matriz[$i][$k] = $matriz[$j][$k];
							$matriz[$j][$k] = $temp;
							$sinal *= -1;
						}
					}
				} // for ($j = $i + 1 ...)
			} // if ($matriz[i][i] == 0)

			if ($matriz[$i][$i] !== 1 && $matriz[$i][$i] !== -1) {
				$temp = 1 / $matriz[$i][$i];
				for ($j = $i; $j < $n; $j++) {
					$matriz[$i][$j] = $matriz[$i][$j] * $temp;
				}
				$m *= $temp;
			}

			for ($j = $i + 1; $j < $n; $j++) {
				if ($matriz[$j][$i] === 0)
					continue;

				if ($matriz[$i][$i] * $matriz[$j][$i] >= 0) {
					$matriz[$j][$i] = -1 * $matriz[$j][$i] * $matriz[$i][$i] + $matriz[$j][$i];
				} else {
					$matriz[$j][$i] = $matriz[$j][$i] * $matriz[$i][$i] - $matriz[$j][$i];
				}
			}
		} // for ($i = 0 ...)

		for ($i = 0; $i < $n; $i++) {
			$det *= $matriz[$i][$i];
		}

		$det *= $sinal;
		$det /= $m;

		return $det;
	}

	public static function imprime($matriz)
	{
		$n = count($matriz);
		for ($i = 0; $i < $n; $i++) {
			for ($j = 0; $j < $n; $j++) {
				echo sprintf("%4.2f\t", $matriz[$i][$j]);
				if ($j + 1 === $n)
					echo "\n";
			}
		}
	}

}

// TESTE

// estrutura para teste
/*
$matriz = [
	[1, 1, 1],
	[0, 1, 1],
	[0, 0, 1]
];
$matriz = [
	[1, 1, 1],
	[1, 1, 1],
	[1, 1, 1]
];
$matriz = [
	[1, 1, 1, 1],
	[0, 0, 2, -2],
	[-1, -1, 5, 2],
	[-4, -3, 5, 3]
];
$matriz = [
	[1, 2, 5, 3, 2],
	[1, 3, 7, 3, 4],
	[0, 5, 2, 2, 1],
	[1, 3, 0, 1, 2],
	[0, 6, 7, 4, 7]
];
*/

$matriz = [
	[2, -1, 0, 0],
	[-1, 2, -1, 0],
	[0, -1, 2, -1],
	[0, 0, -1, 2]
];

echo "\nMatriz:\n\n";
DeterminanteNxN::imprime($matriz);
echo "\n------------------------------------------\n";
$det = DeterminanteNxN::calcular($matriz);
echo "\nMatriz triangular:\n\n";
DeterminanteNxN::imprime($matriz);
echo "\n------------------------------------------\n";
echo "\n\nDeterminante = $det\n\n";