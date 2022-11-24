BaseApiClient
            <- protocol, domain, port, base_path, secure_options, timeout, allow_redirects
            <- Guzzle\Client
    |
    - -- CallApiClient
    |   |
    |   - -- import(manager_id, city_id, calls): int (Imported calls count)
    |   - -- search(manager_id, from, to): CallSearchResponse
    |   - -- getStatistics(manager_id, from, to): CallStatisticsResponse
    |
    - -- CallRecordsApiClient
    |   | 
    |   - -- create(manager_id, $record): CallRecordResponse
    |   - -- get(record_uuid): CallRecordResponse
    |
    - -- ... 

inheritance or composition


CallCpiClient(options, client = null)
