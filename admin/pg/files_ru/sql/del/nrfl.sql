DROP TABLE nrfl%;

DELETE FROM nrtb WHERE tbnm='nrfl';
DELETE FROM nrat WHERE attb='nrfl%';
DELETE FROM nrcf WHERE cftb='nrfl%';
DELETE FROM nrnv WHERE nvtb IN ('nrfl%');
DELETE FROM nrfs WHERE fsid='6';
