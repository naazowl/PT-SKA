<style>
    .msg-page { color: #172b4d; }

    .msg-page .admin-heading {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 20px; margin-bottom: 28px;
    }
    .msg-page .admin-heading h1 {
        margin-bottom: 7px; color: #142746;
        font-size: clamp(25px, 3vw, 30px); font-weight: 750; letter-spacing: -1px;
    }
    .msg-page .admin-heading p { margin: 0; color: #8491a7; font-size: 14px; }

    .msg-btn-main {
        display: inline-flex; align-items: center; justify-content: center; gap: 9px;
        padding: 12px 19px; border: 0; border-radius: 12px;
        background: linear-gradient(135deg, #2878ff, #155eef); color: #fff;
        font-size: 13px; font-weight: 650; text-decoration: none; cursor: pointer;
        box-shadow: 0 7px 16px rgba(37, 99, 235, .18);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .msg-btn-main:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 10px 22px rgba(37, 99, 235, .25); }

    .msg-alert {
        display: flex; align-items: flex-start; gap: 10px; margin-bottom: 20px;
        padding: 14px 16px; border-radius: 12px; font-size: 13px; line-height: 1.7;
    }
    .msg-alert-success { color: #166534; background: #f0fdf4; border: 1px solid #bbf7d0; }
    .msg-alert-error { color: #991b1b; background: #fef2f2; border: 1px solid #fecaca; }

    .msg-panel {
        overflow: hidden; border: 1px solid #e8edf5; border-radius: 20px;
        background: #fff; box-shadow: 0 10px 35px rgba(25, 48, 84, .045);
    }
    .msg-panel-top {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 15px; padding: 24px 28px; border-bottom: 1px solid #edf1f7;
    }
    .msg-panel-title { display: flex; align-items: center; gap: 13px; }
    .msg-panel-icon {
        display: flex; width: 44px; height: 44px; align-items: center; justify-content: center;
        flex-shrink: 0; border-radius: 14px; background: #edf4ff; color: #2563eb; font-size: 21px;
    }
    .msg-panel-title h5 { margin: 0 0 4px; color: #172b4d; font-size: 16px; font-weight: 750; }
    .msg-panel-title p { margin: 0; color: #8b97aa; font-size: 12px; }

    .msg-total {
        padding: 8px 12px; border: 1px solid #e5edff; border-radius: 10px;
        background: #f5f8ff; color: #3568cf; font-size: 12px; font-weight: 650;
    }
    .msg-total-unread { border-color: #ffe3c2; background: #fff7ec; color: #c26a00; }
    .msg-top-badges { display: flex; gap: 8px; flex-wrap: wrap; }

    /* Toolbar: filter + search */
    .msg-toolbar {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 14px; padding: 16px 28px; border-bottom: 1px solid #edf1f7; background: #fafbfe;
    }
    .msg-tabs { display: flex; gap: 6px; flex-wrap: wrap; }
    .msg-tab {
        padding: 8px 14px; border: 1px solid #e5eaf3; border-radius: 10px; background: #fff;
        color: #66758d; font-size: 12px; font-weight: 700; text-decoration: none; transition: all .18s ease;
    }
    .msg-tab:hover { color: #2563eb; border-color: #cfe0ff; }
    .msg-tab.active { color: #fff; background: #2563eb; border-color: #2563eb; }

    .msg-search { display: flex; gap: 8px; }
    .msg-search input {
        min-width: 230px; padding: 9px 13px; color: #172b4d; background: #fff;
        border: 1px solid #e2e8f0; border-radius: 10px; font-size: 13px; outline: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }
    .msg-search input:focus { border-color: #60a5fa; box-shadow: 0 0 0 4px rgba(59, 130, 246, .10); }
    .msg-search button {
        padding: 9px 15px; border: 1px solid #d6e4ff; border-radius: 10px;
        background: #f5f8ff; color: #2563eb; font-size: 12px; font-weight: 700; cursor: pointer;
    }
    .msg-search button:hover { background: #2563eb; color: #fff; }

    /* Table */
    .msg-table-wrap { overflow-x: auto; }
    .msg-table { width: 100%; min-width: 800px; margin: 0; border-collapse: separate; border-spacing: 0; }
    .msg-table thead th {
        padding: 16px 14px; border-bottom: 1px solid #edf1f7; background: #fafbfe; color: #8b97aa;
        font-size: 10px; font-weight: 750; letter-spacing: 1px; text-transform: uppercase; white-space: nowrap;
    }
    .msg-table thead th:first-child, .msg-table tbody td:first-child { padding-left: 28px; }
    .msg-table thead th:last-child, .msg-table tbody td:last-child { padding-right: 28px; }
    .msg-table tbody td { padding: 19px 14px; border-bottom: 1px solid #f0f3f8; vertical-align: middle; }
    .msg-table tbody tr:last-child td { border-bottom: none; }
    .msg-table tbody tr { transition: background .2s ease; }
    .msg-table tbody tr:hover { background: #fafcff; }
    .msg-table tbody tr.is-unread { background: #f8fbff; }

    .msg-sender-col { width: 240px; }
    .msg-date-col { width: 150px; }
    .msg-status-col { width: 125px; }
    .msg-action-col { width: 180px; }

    .msg-sender { display: flex; align-items: center; gap: 12px; min-width: 0; }
    .msg-avatar {
        display: flex; width: 42px; height: 42px; flex-shrink: 0; align-items: center; justify-content: center;
        border-radius: 13px; background: #edf4ff; color: #2563eb; font-size: 15px; font-weight: 800;
    }
    .msg-sender-name { display: block; color: #1b2c49; font-size: 13px; font-weight: 750; overflow-wrap: anywhere; }
    .msg-sender-email { display: block; margin-top: 2px; color: #8995a9; font-size: 12px; overflow-wrap: anywhere; }

    .msg-info { min-width: 240px; max-width: 420px; }
    .msg-info-subject {
        display: block; margin-bottom: 6px; color: #1b2c49; font-size: 13px;
        font-weight: 750; line-height: 1.55; overflow-wrap: anywhere;
    }
    .is-unread .msg-info-subject { font-weight: 800; }
    .msg-info-excerpt {
        display: -webkit-box; overflow: hidden; margin: 0; color: #8995a9; font-size: 12px;
        line-height: 1.65; overflow-wrap: anywhere; -webkit-box-orient: vertical; -webkit-line-clamp: 2;
    }

    .msg-date { color: #53627a; font-size: 12px; font-weight: 550; white-space: nowrap; }
    .msg-date small { display: block; margin-top: 2px; color: #9aa7bb; font-size: 11px; font-weight: 500; }

    .msg-status {
        display: inline-flex; align-items: center; gap: 7px; padding: 7px 11px;
        border-radius: 30px; font-size: 11px; font-weight: 750; white-space: nowrap;
    }
    .msg-status-dot { width: 7px; height: 7px; border-radius: 50%; background: currentColor; }
    .msg-status-new { background: #fff3e0; color: #c26a00; }
    .msg-status-read { background: #e8f8ef; color: #168454; }

    .msg-action-group { display: flex; align-items: center; justify-content: flex-end; gap: 7px; white-space: nowrap; }
    .msg-action-group form { margin: 0; }
    .msg-btn {
        display: inline-flex; align-items: center; justify-content: center; min-width: 48px;
        padding: 8px 11px; border: 1px solid transparent; border-radius: 9px; background: #fff;
        font-size: 11px; font-weight: 700; text-decoration: none; cursor: pointer; transition: all .18s ease;
    }
    .msg-btn-view { border-color: #d6e4ff; background: #f5f8ff; color: #2563eb; }
    .msg-btn-view:hover { border-color: #2563eb; background: #2563eb; color: #fff; }
    .msg-btn-neutral { border-color: #e2e8f0; background: #f8fafc; color: #5b6b82; }
    .msg-btn-neutral:hover { border-color: #5b6b82; background: #5b6b82; color: #fff; }
    .msg-btn-delete { border-color: #ffe0e0; background: #fff6f6; color: #df454b; }
    .msg-btn-delete:hover { border-color: #e5484d; background: #e5484d; color: #fff; }

    .msg-empty { padding: 60px 20px; text-align: center; }
    .msg-empty-icon {
        display: flex; width: 60px; height: 60px; align-items: center; justify-content: center;
        margin: 0 auto 16px; border-radius: 18px; background: #edf4ff; color: #2563eb; font-size: 27px;
    }
    .msg-empty h6 { margin-bottom: 7px; color: #172b4d; font-size: 15px; font-weight: 750; }
    .msg-empty p { margin: 0; color: #8995a9; font-size: 13px; }

    .msg-pagination { padding: 20px 28px; border-top: 1px solid #edf1f7; }
    .msg-pagination nav p { margin-bottom: 0; }

    /* Detail & form */
    .msg-detail-body { padding: 28px; }
    .msg-detail-meta {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px; margin-bottom: 26px; padding: 18px; border: 1px solid #edf1f7;
        border-radius: 14px; background: #fafbfe;
    }
    .msg-meta-label {
        display: block; margin-bottom: 4px; color: #8b97aa; font-size: 10px;
        font-weight: 750; letter-spacing: 1px; text-transform: uppercase;
    }
    .msg-meta-value { color: #1b2c49; font-size: 13px; font-weight: 650; overflow-wrap: anywhere; }
    .msg-meta-value a { color: #2563eb; text-decoration: none; }
    .msg-detail-subject { margin-bottom: 14px; color: #142746; font-size: 20px; font-weight: 800; letter-spacing: -.4px; }
    .msg-detail-text {
        padding: 22px; border: 1px solid #edf1f7; border-radius: 14px; color: #3b4a63;
        font-size: 14px; line-height: 1.9; white-space: pre-line; overflow-wrap: anywhere;
    }
    .msg-detail-actions { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 24px; }
    .msg-detail-actions form { margin: 0; }
    .msg-detail-actions .msg-btn { padding: 11px 16px; font-size: 12px; }

    .msg-form { display: flex; flex-direction: column; gap: 18px; padding: 28px; }
    .msg-form-group label { display: block; margin-bottom: 8px; color: #334155; font-size: 13px; font-weight: 700; }
    .msg-form-group small { display: block; margin-top: 6px; color: #8b97aa; font-size: 12px; }
    .msg-input {
        display: block; width: 100%; padding: 13px 15px; color: #172554; background: #f8fafc;
        border: 1px solid #e2e8f0; border-radius: 12px; outline: none; font-family: inherit;
        font-size: 14px; transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    }
    textarea.msg-input { min-height: 110px; resize: vertical; line-height: 1.8; }
    .msg-input:focus { background: #fff; border-color: #60a5fa; box-shadow: 0 0 0 4px rgba(59, 130, 246, .10); }
    .msg-input.is-invalid { border-color: #ef4444; }
    .msg-error { display: block; margin-top: 6px; color: #dc2626; font-size: 12px; }
    .msg-form-actions { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }

    @media (max-width: 768px) {
        .msg-page .admin-heading { align-items: flex-start; }
        .msg-panel-top, .msg-toolbar { padding: 18px 20px; }
        .msg-table thead th:first-child, .msg-table tbody td:first-child { padding-left: 20px; }
        .msg-table thead th:last-child, .msg-table tbody td:last-child { padding-right: 20px; }
        .msg-pagination { padding: 18px 20px; }
        .msg-detail-body, .msg-form { padding: 20px; }
        .msg-search, .msg-search input { width: 100%; }
    }
</style>