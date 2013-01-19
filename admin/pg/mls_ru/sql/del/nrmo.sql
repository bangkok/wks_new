DROP TABLE IF EXISTS nrmo%;

DELETE FROM nrtb WHERE tbnm='nrmo%';
DELETE FROM nrat WHERE attb='nrmo%';
DELETE FROM nrcf WHERE cftb='nrmo%';

DELETE FROM nrnv WHERE nvtb IN ('nrmo%', 'nrmm%', 'nrmt%', 'nrml%', 'nrmc%');
