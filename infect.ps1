# Infection Script für Windows
$projectRoot = Get-Location
$infectionPath = ".\vendor\bin\infection"
$outputDir = "$projectRoot\storage\logs\coverage-report"

# Erstelle Verzeichnis, falls nicht vorhanden
if (-not (Test-Path -Path $outputDir)) {
	New-Item -ItemType Directory -Path $outputDir | Out-Null
}

Write-Host "Führe Infection aus..."
$date = Get-Date -Format "yyyyMMdd_HHmmss"
$reportFile = "$outputDir\phpInfect\infect_$date.html"
& php $infectionPath --threads=max --logger-html="$reportFile"

Write-Host "Bericht wurde erstellt unter:"
Write-Host "file:///$outputDir\phpInfect\infect_$date.html"
